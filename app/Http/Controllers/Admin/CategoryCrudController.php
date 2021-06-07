<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Contracts\CategoryContract;
use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Category;

class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('категорию', 'Категория');
    }

    protected function setupShowOperation()
    {
        CRUD::column(CategoryContract::TITLE)->label('Название');
        CRUD::column(CategoryContract::TITLE_KZ)->label('Название на казахском');
        CRUD::column(CategoryContract::TITLE_EN)->label('Название на англииском');
    }

    protected function setupListOperation()
    {
        CRUD::column(CategoryContract::TITLE)->label('Название');
        CRUD::column(CategoryContract::TITLE_KZ)->label('Название на казахском');
        CRUD::column(CategoryContract::TITLE_EN)->label('Название на англииском');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);
        CRUD::field(CategoryContract::TITLE)->label('Название *');
        CRUD::field(CategoryContract::TITLE_KZ)->label('Название на казахском');
        CRUD::field(CategoryContract::TITLE_EN)->label('Название на англииском');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
