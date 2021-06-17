<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\BookingContract;
use App\Services\Payment\PaymentService;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            BookingContract::ID =>  $this->{BookingContract::ID},
            BookingContract::USER_ID    =>  $this->{BookingContract::USER_ID},
            BookingContract::ORGANIZATION_ID    =>  $this->{BookingContract::ORGANIZATION_ID},
            BookingContract::ORGANIZATION_TABLE_LIST_ID =>  $this->{BookingContract::ORGANIZATION_TABLE_LIST_ID},
            BookingContract::TIME   =>  $this->{BookingContract::TIME},
            BookingContract::DATE   =>  $this->{BookingContract::DATE},
            BookingContract::COMMENT    =>  $this->{BookingContract::COMMENT},
            BookingContract::PAYMENT_URL    =>  $this->{BookingContract::PAYMENT_URL},
            BookingContract::PAYMENT_ID =>  $this->{BookingContract::PAYMENT_ID},
            BookingContract::CARD_ID    =>  $this->{BookingContract::CARD_ID},
            BookingContract::PRICE  =>  $this->{BookingContract::PRICE},
            BookingContract::CURRENCY   =>  $this->{BookingContract::CURRENCY},
            BookingContract::PG_SIG =>  PaymentService::paySignature($this->{BookingContract::PAYMENT_ID}),
        ];
    }
}
