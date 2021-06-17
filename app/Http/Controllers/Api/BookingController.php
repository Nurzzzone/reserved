<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Booking\BookingCollection;

use App\Services\Booking\BookingService;
use App\Services\Payment\PaymentService;

use App\Http\Requests\Booking\BookingCreateRequest;
use App\Http\Requests\Booking\BookingPaginateRequest;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\MainContract;

class BookingController extends Controller
{
    protected $bookingService;
    protected $paymentService;

    public function __construct(BookingService $bookingService, PaymentService $paymentService) {
        $this->bookingService       =   $bookingService;
        $this->paymentService       =   $paymentService;
    }

    public function create(BookingCreateRequest $request):object
    {
        $booking    =   $this->bookingService->create($request->validated());
        print_r($booking);
        exit;
        $booking    =   $this->paymentService->create($booking);
        return new BookingResource($booking);
    }

    public function delete($id):void
    {
        $this->bookingService->delete($id);
    }

    public function getById($id)
    {
        if ($booking    =   $this->bookingService->getById($id)) {
            return new BookingResource($booking);
        }
        return response([
            MainContract::MESSAGE  =>  'Booking Not Found'
        ],404);
    }

    public function getByUserId($userId, BookingPaginateRequest $request):object
    {
        $booking    =   $this->bookingService->getByUserId($userId,$request->validated()[BookingContract::PAGINATE]);
        return new BookingCollection($booking);
    }

    public function getByOrganizationId($organizationId, BookingPaginateRequest $request):object
    {
        $booking    =   $this->bookingService->getByOrganizationId($organizationId, $request->validated()[BookingContract::PAGINATE]);
        return new BookingCollection($booking);
    }

    public function getByTableId($tableId, BookingPaginateRequest $request):object
    {
        $booking    =   $this->bookingService->getByTableId($tableId, $request->validated()[BookingContract::PAGINATE]);
        return new BookingCollection($booking);
    }

    public function getByDate($date, BookingPaginateRequest $request):object
    {
        $booking    =   $this->bookingService->getByDate($date, $request->validated()[BookingContract::PAGINATE]);
        return new BookingCollection($booking);
    }

}
