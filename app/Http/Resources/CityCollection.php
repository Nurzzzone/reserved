<?php

namespace App\Http\Resources;

use App\Domain\Contracts\CityContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                CityContract::ID         =>  $item->id,
                CityContract::TITLE      =>  $item->title,
                CityContract::TITLE_KZ   =>  $item->title_kz,
                CityContract::TITLE_EN   =>  $item->title_en,
            ];
        });
    }
}
