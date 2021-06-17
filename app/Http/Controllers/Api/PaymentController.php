<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Payment\PaymentService;
use App\Services\Booking\BookingService;
use App\Services\Api\ApiService;

use App\Domain\Contracts\BookingContract;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller {

    protected $paymentService;
    protected $bookingService;
    protected $apiService;

    public function __construct(PaymentService $paymentService, BookingService $bookingService, ApiService $apiService) {
        $this->paymentService   =   $paymentService;
        $this->bookingService   =   $bookingService;
        $this->apiService       =   $apiService;
    }

    public function card($id) {
        if ($card   =   $this->paymentService->cardAdd($id)) {
            return $card;
        }
        return response(['message'  =>  'Произошла ошибка'],400);
    }

    public function cardResult(Request $request):void
    {
        Log::info('card result', $request->all());
        /*
         {"pg_order_id":"27","pg_payment_id":"490819562","pg_amount":"25","pg_currency":"KZT","pg_ps_amount":"25","pg_ps_full_amount":"25","pg_ps_currency":"KZT","pg_payment_system":"FORTEBANKECOMKZT","pg_description":"Бронирование столика №1","pg_result":"1","pg_payment_date":"2021-06-18 01:18:02","pg_can_reject":"0","pg_need_phone_notification":"0","pg_need_email_notification":"0","pg_captured":"1","pg_card_pan":"4263-43XX-XXXX-9479","pg_card_exp":"02/26","pg_card_owner":"ERSAIYN TAMABAY","pg_card_brand":"VI","pg_salt":"gq0CJ5RrqhekOg9F","pg_sig":"7754fa99f3045e066aea0e521dc3140e"}
         */
    }

    public function result(Request $request):void
    {
        $this->paymentService->result($request->all());
        if ($this->bookingService->result($request->all())) {
            $this->apiService->booking($request->input(BookingContract::PG_ORDER_ID));
        }
    }

    public function post(Request $request) {
        $this->paymentService->post($request->all());
    }

    public function check(Request $request) {
        $this->paymentService->check($request->all());
    }

    public function success(Request $request) {
        return $this->paymentService->success($request->all());
    }

    public function failure(Request $request) {
        return $this->paymentService->failure($request->all());
    }
}
