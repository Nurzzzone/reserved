<?php

namespace App\Http\Resources;

use App\Domain\Contracts\OrganizationTableListContract;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationTableListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            OrganizationTableListContract::ID   =>  $this->id,
            OrganizationTableListContract::ORGANIZATION_ID  =>  $this->organization_id,
            OrganizationTableListContract::ORGANIZATION_TABLE_ID    =>  $this->organization_table_id,
            OrganizationTableListContract::LIMIT   =>  $this->limit,
            OrganizationTableListContract::STATUS   =>  $this->status,
        ];
    }
}
