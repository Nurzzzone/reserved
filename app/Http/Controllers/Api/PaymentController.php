<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\MainContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Payment\PaymentService;
use App\Services\Booking\BookingService;
use App\Services\Api\ApiService;

use App\Domain\Contracts\BookingContract;
use App\Http\Requests\Payment\PaymentCardResultRequest;
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

    public function cardResult(PaymentCardResultRequest $request):void
    {
        $data   =   $request->validated();
        Log::info('card result',$data);
        exit;
        if ((int)$data[MainContract::PG_RESULT] === 1) {
            $this->bookingService->update($data[MainContract::PG_ORDER_ID],[
                MainContract::STATUS    =>  MainContract::ON
            ]);
        } else {
            $this->bookingService->update($data[MainContract::PG_ORDER_ID],[
                MainContract::STATUS    =>  MainContract::OFF
            ]);
        }
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
