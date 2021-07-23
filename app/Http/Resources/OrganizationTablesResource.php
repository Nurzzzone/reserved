<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\OrganizationTablesContract;

class OrganizationTablesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            OrganizationTablesContract::ID  =>  $this->{OrganizationTablesContract::ID},
            OrganizationTablesContract::NAME   =>  $this->{OrganizationTablesContract::NAME},
            OrganizationTablesContract::STATUS  =>  $this->{OrganizationTablesContract::STATUS},
            OrganizationTablesContract::ORGANIZATION_TABLES =>  new OrganizationTableListCollection($this->{OrganizationTablesContract::ORGANIZATION__TABLES})
        ];
    }
}
