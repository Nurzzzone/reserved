<?php

namespace App\Http\Resources;

use App\Domain\Contracts\BookingContract;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            BookingContract::ID    =>  $this->id,
            BookingContract::ORGANIZATION_ID    => new OrganizationResource($this->organization),
            BookingContract::ORGANIZATION_TABLE_ID  =>  New OrganizationTablesResource($this->organizationTables),
            BookingContract::START =>  $this->start,
            BookingContract::END =>  $this->end,
            BookingContract::DATE   =>  $this->date,
            BookingContract::PHONE =>  $this->phone,
            BookingContract::COMMENT  =>  $this->comment,
            BookingContract::STATUS  =>  $this->status,
            BookingContract::CREATED_AT =>  $this->created_at,
            BookingContract::URL    =>  $this->payment
        ];
    }
}
