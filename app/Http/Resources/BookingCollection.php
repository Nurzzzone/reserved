<?php

namespace App\Http\Resources;

use App\Domain\Contracts\BookingContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return new BookingResource($item);
        });
    }
}
