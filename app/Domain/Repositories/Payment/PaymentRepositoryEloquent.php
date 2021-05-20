<?php


namespace App\Domain\Repositories\Payment;

use App\Models\Payment;

class PaymentRepositoryEloquent implements PaymentRepositoryInterface
{
    public function create($data) {
        return Payment::create($data);
    }
}
