<?php

namespace App\Http\Resources;

use App\Domain\Contracts\CategoryContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                CategoryContract::ID    =>  $item->id,
                CategoryContract::TITLE =>  $item->title,
                CategoryContract::TITLE_KZ  =>  $item->title_kz,
                CategoryContract::TITLE_EN  =>  $item->title_en
            ];
        });
    }
}
