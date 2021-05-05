<?php


namespace App\Domain\Repositories\Category;

use App\Models\Category;
use App\Domain\Contracts\CategoryContract;

class CategoryRepositoryEloquent implements CategoryRepositoryInterface
{
    public function list()
    {
        return Category::get();
    }
}
