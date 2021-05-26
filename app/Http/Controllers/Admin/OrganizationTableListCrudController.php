<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\OrganizationTableListContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Domain\Repositories\Organization\OrganizationRepositoryEloquent as OrganizationRepository;
use App\Http\Requests\OrganizationTableListRequest;
use App\Models\OrganizationTableList;
use App\Models\OrganizationTables;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

class OrganizationTableListCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    public $organizationsId;

    public function setup()
    {
        CRUD::setModel(\App\Models\OrganizationTableList::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/organizationtablelist');
        CRUD::setEntityNameStrings('стол', 'Столы');
        if (backpack_user()->role === OrganizationTableListContract::TRANSLATE[OrganizationTableListContract::MODERATOR]) {
            $this->organizationsId  =   (new OrganizationRepository())->getIdsByUserId(backpack_user()->id);
            $this->crud->addClause('whereIn', OrganizationTableListContract::ORGANIZATION_ID,$this->organizationsId);
        }
    }

    protected function setupShowOperation()
    {
        CRUD::column(OrganizationTableListContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationTableListContract::ORGANIZATION_TABLE_ID)->type('select')->label('Секция')
            ->entity('organizationTable')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::NAME);
        CRUD::column(OrganizationTableListContract::KEY)->label('ID');
        CRUD::column(OrganizationTableListContract::TITLE)->label('Название стола');
        CRUD::column(OrganizationTableListContract::LIMIT)->label('Лимит');
        CRUD::column(OrganizationTableListContract::STATUS)->label('Статус');
    }

    protected function setupListOperation()
    {
        CRUD::column(OrganizationTableListContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationTableListContract::ORGANIZATION_TABLE_ID)->type('select')->label('Секция')
            ->entity('organizationTable')->model('App\Models\OrganizationTables')->attribute(OrganizationTablesContract::NAME);
        CRUD::column(OrganizationTableListContract::TITLE)->label('Название стола');
        CRUD::column(OrganizationTableListContract::LIMIT)->label('Лимит');
        CRUD::column(OrganizationTableListContract::STATUS)->label('Статус');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrganizationTableListRequest::class);
        CRUD::field(OrganizationContract::TITLE)->label('Название стола');
        CRUD::field(OrganizationContract::LIMIT)->label('Лимит на человека');
        CRUD::field(OrganizationTableListContract::STATUS)->type('select_from_array')
            ->label('Статус')->options([
                OrganizationTableListContract::ENABLED    =>  OrganizationTableListContract::TRANSLATE[OrganizationTableListContract::ENABLED],
                OrganizationTableListContract::DISABLED   =>  OrganizationTableListContract::TRANSLATE[OrganizationTableListContract::DISABLED],
            ]);
    }

    protected function setupUpdateOperation() {
        $this->setupCreateOperation();
    }

    public function list(Request $request) {
        if ($request->has('form')) {
            $form   =   $request->input('form');
            $organization   =   $form[3][OrganizationTableListContract::VALUE];
            if ($organization) {
                return OrganizationTableList::where(OrganizationTableListContract::ORGANIZATION_ID,$organization)->paginate(10);
            }
        }
        return [];
    }
}
