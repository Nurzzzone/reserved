<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Http\Requests\OrganizationTablesRequest;
use App\Models\OrganizationTables;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Domain\Repositories\Organization\OrganizationRepositoryEloquent as OrganizationRepository;
use Illuminate\Http\Request;

class OrganizationTablesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    public $organizationsId;

    public function setup()
    {
        CRUD::setModel(\App\Models\OrganizationTables::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/organizationtables');
        CRUD::setEntityNameStrings('Комната', 'Комнаты');
        if (backpack_user()->role === OrganizationTablesContract::TRANSLATE[OrganizationTablesContract::MODERATOR]) {
            $this->organizationsId  =   (new OrganizationRepository())->getIdsByUserId(backpack_user()->id);
            $this->crud->addClause('whereIn', OrganizationTablesContract::ORGANIZATION_ID,$this->organizationsId);
        }
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column(OrganizationTablesContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationTablesContract::KEY)->label('ID');
        CRUD::column(OrganizationTablesContract::NAME)->label('Название секции');
        CRUD::column(OrganizationTablesContract::STATUS)->label('Статус');
    }

    protected function setupListOperation()
    {
        CRUD::column(OrganizationTablesContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationTablesContract::NAME)->label('Название секции');
        CRUD::column(OrganizationTablesContract::STATUS)->label('Статус');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrganizationTablesRequest::class);
        CRUD::field(OrganizationTablesContract::ORGANIZATION_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::field(OrganizationTablesContract::NAME)->label('Название секции');
        CRUD::field(OrganizationTablesContract::STATUS)->type('select_from_array')
            ->label('Статус')->options([
                OrganizationTablesContract::ENABLED    =>  OrganizationTablesContract::TRANSLATE[OrganizationTablesContract::ENABLED],
                OrganizationTablesContract::DISABLED   =>  OrganizationTablesContract::TRANSLATE[OrganizationTablesContract::DISABLED],
            ]);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
