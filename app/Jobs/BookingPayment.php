<?php

namespace App\Jobs;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\PaymentContract;
use App\Services\Organization\OrganizationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Services\Payment\PaymentService;
use App\Services\Sms\SmsService;
use App\Services\User\UserService;

class BookingPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    public function __construct($data) {
        $this->data  =   $data;
    }

    public function handle(OrganizationService $organizationService, PaymentService $paymentService, SmsService $smsService, UserService $userService) {

        $organization   =   $organizationService->getById($this->data[1]);
        $user           =   $userService->getById($this->data[2]);
        $payment        =   $paymentService->urlAdmin($this->data[0],$organization->price,$organization->title,$this->data[2],$user->phone);
        try {
            if (sizeof($payment)>0 && array_key_exists(PaymentContract::PG_REDIRECT_URL,$payment)) {
                $paymentService->create([
                    PaymentContract::BOOKING_ID =>  $this->data[0],
                    PaymentContract::PRICE  =>  $organization->price,
                    PaymentContract::PG_PAYMENT_ID  =>  $payment[PaymentContract::PG_PAYMENT_ID],
                    PaymentContract::PG_REDIRECT_URL    =>  $payment[PaymentContract::PG_REDIRECT_URL],
                    PaymentContract::PG_SIG =>  $payment[PaymentContract::PG_SIG],
                    PaymentContract::STATUS =>  PaymentContract::ENABLED
                ]);

                $smsService->sendBooking($user->phone,$organization->title,$payment[PaymentContract::PG_REDIRECT_URL]);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
