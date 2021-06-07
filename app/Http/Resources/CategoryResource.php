<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\CategoryContract;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            CategoryContract::ID    =>  $this->id,
            CategoryContract::TITLE =>  $this->title,
            CategoryContract::TITLE_KZ  =>  $this->title_kz,
            CategoryContract::TITLE_EN  =>  $this->title_en
        ];
    }
}
