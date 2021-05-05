<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\OrganizationTablesContract;

class OrganizationTablesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            OrganizationTablesContract::ID  =>  $this->id,
            OrganizationTablesContract::TITLE   =>  $this->title,
            OrganizationTablesContract::LIMIT   =>  $this->limit,
            OrganizationTablesContract::STATUS  =>  $this->status
        ];
    }
}
