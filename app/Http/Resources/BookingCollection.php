<?php

namespace App\Http\Resources;

use App\Domain\Contracts\BookingContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                BookingContract::ID    =>  $item->id,
                BookingContract::ORGANIZATION_ID    => new OrganizationResource($item->organization),
                BookingContract::ORGANIZATION_TABLE_ID  =>  New OrganizationTablesResource($item->organizationTables),
                BookingContract::START =>  $item->start,
                BookingContract::END =>  $item->end,
                BookingContract::PHONE =>  $item->phone,
                BookingContract::COMMENT  =>  $item->comment,
                BookingContract::STATUS  =>  $item->status,
                BookingContract::CREATED_AT =>  $item->created_at
            ];
        });
    }
}
