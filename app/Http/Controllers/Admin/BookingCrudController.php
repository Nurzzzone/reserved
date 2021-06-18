<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\OrganizationTableListContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Domain\Contracts\UserContract;
use App\Http\Requests\BookingRequest;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Booking;
use App\Domain\Repositories\Organization\OrganizationRepositoryEloquent as OrganizationRepository;

use App\Services\Api\ApiService;
use App\Services\Organization\OrganizationService;
use App\Services\OrganizationTableList\OrganizationTableListService;
use App\Services\Booking\BookingService;

use App\Jobs\BookingPayment;
use http\Env\Request;

use App\Helpers\Time\Time;

class BookingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    public $organizationsId;

    protected $organizationTableListService;
    protected $organizationService;
    protected $bookingService;

    public function __construct(OrganizationTableListService $organizationTableListService, OrganizationService $organizationService, BookingService $bookingService) {
        parent::__construct();
        $this->organizationTableListService =   $organizationTableListService;
        $this->organizationService          =   $organizationService;
        $this->bookingService               =   $bookingService;
    }

    public function setup() {
        CRUD::setModel(Booking::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/booking');
        CRUD::setEntityNameStrings('Бронирование', 'Бронирование');
        if (backpack_user()->role === BookingContract::TRANSLATE[BookingContract::MODERATOR]) {
            $this->crud->setListView('backpack.booking.list');
            $this->organizationsId  =   (new OrganizationRepository())->getIdsByUserId(backpack_user()->id);
        }
    }

    public function store(ApiService $apiService) {
        $parameter  =   (array) $this->crud->getRequest()->request;
        foreach ($parameter as &$param) {
            $parameter  =   $param;
            break;
        }
        $organization   =   $this->organizationService->getById($parameter[BookingContract::ORGANIZATION_ID]);
        $this->crud->removeField(BookingContract::TIME);
        $this->crud->addField(['type' => 'hidden', 'name' => BookingContract::TIME]);
        $this->crud->getRequest()->request->add([
            BookingContract::TIME   =>  Time::toLocal(date('Y-m-d').' '.$parameter[BookingContract::TIME], $parameter[BookingContract::TIMEZONE]),
            BookingContract::PRICE  =>  $organization->{BookingContract::PRICE}
        ]);
        $response   =   $this->traitStore();
        BookingPayment::dispatch([
            BookingContract::ID =>  $this->crud->entry->id,
            BookingContract::ORGANIZATION_ID    =>  $parameter[BookingContract::ORGANIZATION_ID],
            BookingContract::USER_ID    =>  $parameter[BookingContract::USER_ID]
        ]);
        return $response;
    }

    public function update() {
        $parameter  =   (array) $this->crud->getRequest()->request;
        foreach ($parameter as &$param) {
            $parameter  =   $param;
            break;
        }
        $this->crud->removeField(BookingContract::TIME);
        $this->crud->addField(['type' => 'hidden', 'name' => BookingContract::TIME]);
        $this->crud->getRequest()->request->add([
            BookingContract::TIME  =>  Time::toLocal(date('Y-m-d').' '.$parameter[BookingContract::TIME], $parameter[BookingContract::TIMEZONE])
        ]);
        return $this->traitUpdate();
    }

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);
        CRUD::column(BookingContract::USER_ID)->type('select')->label('Пользователь')
            ->entity('user')->model('App\Models\User')->attribute(UserContract::NAME);
        CRUD::column(BookingContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(BookingContract::ORGANIZATION_TABLE_LIST_ID)->type('select')->label('Номер стола')
            ->entity('organizationTables')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::TITLE);
        CRUD::column(BookingContract::TIME)->label('Время');
        CRUD::column(BookingContract::DATE)->label('Дата');
        CRUD::column(BookingContract::COMMENT)->label('Комментарии');
        CRUD::column(BookingContract::STATUS)->label('Статус');
    }

    protected function setupListOperation() {
        $this->crud->removeButton('create');
        if (backpack_user()->role === BookingContract::TRANSLATE[BookingContract::MODERATOR]) {
            $this->crud->addClause('whereIn', BookingContract::ORGANIZATION_ID,$this->organizationsId);
        }
        CRUD::column(BookingContract::USER_ID)->type('select')->label('Пользователь')
            ->entity('user')->model('App\Models\User')->attribute(UserContract::PHONE);
        CRUD::column(BookingContract::ORGANIZATION_TABLE_LIST_ID)->type('select')->label('Номер стола')
            ->entity('organizationTables')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::TITLE);
        CRUD::column(BookingContract::TIME)->label('Время');
        CRUD::column(BookingContract::DATE)->label('Дата');
        CRUD::column(BookingContract::STATUS)->label('Статус');
    }

    protected function setupCreateOperation() {
        CRUD::setValidation(BookingRequest::class);
        $organizationTable  =   '';
        if (\request()->has('table')) {
            $table  =   \request()->input('table');
            $organizationTable  =   $this->organizationTableListService->getById($table);
        }
        $this->crud->addField([
            'id'    =>  BookingContract::TIMEZONE,
            'name'  =>  BookingContract::TIMEZONE,
            'type'  =>  'hidden',
        ]);
        $this->crud->addField([
            'label'         => 'Номер телефона',
            'type'          => 'select2_from_ajax',
            'name'          => BookingContract::USER_ID,
            'entity'        => 'user',
            'placeholder'   => '',
            'minimum_input_length'  => '',
            'attribute'     => UserContract::PHONE,
            'data_source'   =>  url('users')
        ]);
        if ($organizationTable) {
            $this->crud->addField([
                'name'  =>  BookingContract::ORGANIZATION_ID,
                'type'  =>  'hidden',
                'value' =>  $organizationTable->organization->id
            ]);
            $this->crud->addField([
                'name'  =>  BookingContract::ORGANIZATION_TABLE_LIST_ID,
                'type'  =>  'hidden',
                'value' =>  $organizationTable->id
            ]);
        } else {
            $this->crud->addField([
                'label'         => 'Заведение',
                'type'          => 'select2_from_ajax',
                'name'          => BookingContract::ORGANIZATION_ID,
                'entity'        => 'organization',
                'placeholder'   => '',
                'minimum_input_length'  => '',
                'attribute'     => OrganizationContract::TITLE,
                'data_source'   =>  url('organization'),
            ]);
            $this->crud->addField([
                'label' =>  'Стол',
                'type'  =>  'select2_from_ajax',
                'name'  =>  BookingContract::ORGANIZATION_TABLE_LIST_ID,
                'entity'    =>  'organizationTables',
                'attribute' =>  OrganizationTableListContract::TITLE,
                'data_source'   =>  url('tables'),
                'placeholder'   =>  'Выберите заведение',
                'minimum_input_length' => 0,
                'include_all_form_fields' => true,
                'dependencies'  => ['organization'],
            ]);
        }
        CRUD::field(BookingContract::TIME)->type('time')->label('Время');
        CRUD::field(BookingContract::DATE)->type('date')->format('Y-m-d')->value(date('Y-m-d'))->label('Дата');
        CRUD::field(BookingContract::COMMENT)->label('Комментарии');
        CRUD::field(BookingContract::STATUS)->type('select_from_array')
            ->label('Статус')->options([
                BookingContract::CHECKING    =>  BookingContract::TRANSLATE[BookingContract::CHECKING],
                BookingContract::ON    =>  BookingContract::TRANSLATE[BookingContract::ON],
                BookingContract::OFF   =>  BookingContract::TRANSLATE[BookingContract::OFF],
            ]);
    }

    protected function setupUpdateOperation() {
        $this->setupCreateOperation();
    }

    public function cancel($id) {
        $this->bookingService->cancel($id);
    }

    public function bookingStatus($date) {
        $arr    =   [];
        $organizations  =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        foreach ($organizations as &$organization) {
            $tables =   $this->organizationTableListService->getByOrganizationId($organization->id);
            foreach ($tables as &$table) {
                $arr[]  =   [
                    'id'        =>  $table->id,
                    'status'    =>  $this->bookingService->status($table->id, $date)
                ];
            }
        }
        return $arr;
    }
}
