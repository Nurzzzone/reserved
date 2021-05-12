<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Domain\Contracts\UserContract;
use App\Http\Requests\BookingRequest;
use App\Services\Api\ApiService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Booking;
use App\Domain\Repositories\Organization\OrganizationRepositoryEloquent as OrganizationRepository;

class BookingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    public $organizationsId;

    public function setup()
    {
        CRUD::setModel(Booking::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/booking');
        CRUD::setEntityNameStrings('Бронирование', 'Бронирование');
        if (backpack_user()->role === BookingContract::TRANSLATE[BookingContract::MODERATOR]) {
            $this->crud->setListView('backpack.booking.list');
            $this->organizationsId  =   (new OrganizationRepository())->getIdsByUserId(backpack_user()->id);
        }
    }

    public function store(ApiService $apiService)
    {
        $response = $this->traitStore();
        $parameter  =   (array) $this->crud->getRequest()->request;
        foreach ($parameter as &$param) {
            $parameter  =   $param;
            break;
        }
        $apiService->booking($parameter);
        return $response;
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column(BookingContract::USER_ID)->type('select')->label('Пользователь')
            ->entity('user')->model('App\Models\User')->attribute(UserContract::NAME);
        CRUD::column(BookingContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(BookingContract::ORGANIZATION_TABLE_ID)->type('select')->label('Номер стола')
            ->entity('organizationTables')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::NAME);
        CRUD::column(BookingContract::START)->label('Начало');
        CRUD::column(BookingContract::END)->label('Конец');
        CRUD::column(BookingContract::PHONE)->label('Номер телефона');
        CRUD::column(BookingContract::COMMENT)->label('Комментарии');
        CRUD::column(BookingContract::STATUS)->label('Статус');
    }

    protected function setupListOperation()
    {
        if (backpack_user()->role === BookingContract::TRANSLATE[BookingContract::MODERATOR]) {
            $this->crud->addClause('whereIn', BookingContract::ORGANIZATION_ID,$this->organizationsId);
        }
        CRUD::column(BookingContract::USER_ID)->type('select')->label('Пользователь')
            ->entity('user')->model('App\Models\User')->attribute(UserContract::NAME);
        CRUD::column(BookingContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(BookingContract::PHONE)->label('Номер телефона');
        CRUD::column(BookingContract::ORGANIZATION_TABLE_ID)->type('select')->label('Номер стола')
            ->entity('organizationTables')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::NAME);
        CRUD::column(BookingContract::START)->label('Начало');
        CRUD::column(BookingContract::END)->label('Конец');
        CRUD::column(BookingContract::STATUS)->label('Статус');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookingRequest::class);

        $this->crud->addField([
            'label'         => 'Имя',
            'type'          => 'select2_from_ajax',
            'name'          => BookingContract::USER_ID,
            'entity'        => 'user',
            'placeholder'   => '',
            'minimum_input_length'  => '',
            'attribute'     => UserContract::PHONE,
            'data_source'   =>  url('users')
        ]);

        $this->crud->addField([
            'label'         => 'Организация',
            'type'          => 'select2_from_ajax',
            'name'          => BookingContract::ORGANIZATION_ID,
            'entity'        => 'organization',
            'placeholder'   => '',
            'minimum_input_length'  => '',
            'attribute'     => OrganizationContract::NAME,
            'data_source'   =>  url('organization')
        ]);

        CRUD::field(BookingContract::ORGANIZATION_TABLE_ID)->type('number')->label('ID стола');

        CRUD::field(BookingContract::START)->type('time')->label('Начало');
        CRUD::field(BookingContract::END)->type('time')->label('Конец');

        CRUD::field(BookingContract::PHONE)->label('Телефон номер');

        CRUD::field(BookingContract::COMMENT)->label('Комментарии');
        CRUD::field(BookingContract::STATUS)->type('select_from_array')
            ->label('Статус')->options([
                BookingContract::CHECKING    =>  BookingContract::TRANSLATE[BookingContract::CHECKING],
                BookingContract::ENABLED    =>  BookingContract::TRANSLATE[BookingContract::ENABLED],
                BookingContract::DISABLED   =>  BookingContract::TRANSLATE[BookingContract::DISABLED],
                BookingContract::CANCELED   =>  BookingContract::TRANSLATE[BookingContract::CANCELED],
                BookingContract::DELETED   =>  BookingContract::TRANSLATE[BookingContract::DELETED],
            ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
