<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Domain\Contracts\MenuContract;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            MenuContract::ID    =>  $this->{MenuContract::ID},
            MenuContract::ORGANIZATION_ID   =>  $this->{MenuContract::ORGANIZATION_ID},
            MenuContract::IMAGE =>  $this->{MenuContract::IMAGE},
            MenuContract::STATUS    =>  $this->{MenuContract::STATUS},
        ];
    }
}
