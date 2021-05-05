<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Category\CategoryService;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService  =   $categoryService;
    }

    public function list()
    {
        return new CategoryCollection($this->categoryService->list());
    }
}
