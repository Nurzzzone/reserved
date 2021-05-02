<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\CityContract;
use App\Domain\Contracts\OrganizationCityContract;
use App\Domain\Contracts\OrganizationContract;
use App\Http\Requests\OrganizationCityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Domain\Repositories\Organization\OrganizationRepositoryEloquent as OrganizationRepository;

class OrganizationCityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\OrganizationCity::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/organizationcity');
        CRUD::setEntityNameStrings('город организаци', 'Города организации');
        if (backpack_user()->role === OrganizationCityContract::TRANSLATE[OrganizationCityContract::MODERATOR]) {
            $this->organizationsId  =   (new OrganizationRepository())->getIdsByUserId(backpack_user()->id);
            $this->crud->addClause('whereIn', OrganizationCityContract::ORGANIZATION_ID,$this->organizationsId);
        }
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column(OrganizationCityContract::USER_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationCityContract::CITY_ID)->type('select')->label('Город')
            ->entity('city')->model('App\Models\City')->attribute(CityContract::TITLE);
        CRUD::column(OrganizationContract::STATUS)->label('Статус');
    }

    protected function setupListOperation()
    {
        CRUD::column(OrganizationCityContract::USER_ID)->type('select')->label('Организация')
            ->entity('organization')->model('App\Models\Organization')->attribute(OrganizationContract::TITLE);
        CRUD::column(OrganizationCityContract::CITY_ID)->type('select')->label('Город')
            ->entity('city')->model('App\Models\City')->attribute(CityContract::TITLE);
        CRUD::column(OrganizationContract::STATUS)->label('Статус');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrganizationCityRequest::class);

        $this->crud->addField([
            'label'         => 'Организация',
            'type'          => 'select2_from_ajax',
            'name'          => OrganizationCityContract::ORGANIZATION_ID,
            'entity'        => 'organization',
            'placeholder'   => '',
            'minimum_input_length'  => '',
            'attribute'     => OrganizationContract::TITLE,
            'data_source'   =>  url('organization')
        ]);

        $this->crud->addField([
            'name'      => OrganizationCityContract::CITY_ID,
            'label'     => 'Город',
            'type'      => 'select',
            'entity'    => 'city',
            'model'     => "App\Models\City",
            'attribute' => CityContract::TITLE,
        ]);
        CRUD::field(OrganizationCityContract::STATUS)->type('select_from_array')
            ->label('Статус')->options([
                OrganizationCityContract::ENABLED    =>  OrganizationCityContract::TRANSLATE[OrganizationCityContract::ENABLED],
                OrganizationCityContract::DISABLED   =>  OrganizationCityContract::TRANSLATE[OrganizationCityContract::DISABLED],
            ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
