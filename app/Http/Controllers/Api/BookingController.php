<?php

namespace App\Http\Controllers\Api;


use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\PaymentContract;
use App\Domain\Contracts\UserContract;
use App\Http\Controllers\Controller;

use App\Http\Resources\Booking\BookingResource;
use App\Http\Resources\Booking\BookingCollection;

use App\Services\Booking\BookingService;
use App\Services\Payment\PaymentService;
use App\Services\User\UserService;
use App\Services\Organization\OrganizationService;

use App\Http\Requests\Booking\BookingCreateRequest;
use App\Http\Requests\Booking\BookingPaginateRequest;
use App\Http\Requests\Booking\BookingGuestRequest;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\MainContract;

class BookingController extends Controller
{
    protected $bookingService;
    protected $paymentService;
    protected $userService;
    protected $organizationService;

    public function __construct(BookingService $bookingService, PaymentService $paymentService, UserService $userService, OrganizationService $organizationService)
    {
        $this->bookingService   =   $bookingService;
        $this->paymentService   =   $paymentService;
        $this->userService      =   $userService;
        $this->organizationService  =   $organizationService;
    }

    public function create(BookingCreateRequest $bookingCreateRequest):object
    {
        if ($booking    =   $this->bookingService->create($bookingCreateRequest->validated())) {
            if ($booking->{BookingContract::PRICE} > 0) {
                $booking    =   $this->paymentService->create($booking);
            }
            return new BookingResource($booking);
        }
        return response([
            MainContract::MESSAGE  =>  'Something Goes Wrong'
        ],400);
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

    public function getByUserId($userId, BookingPaginateRequest $bookingPaginateRequest):object
    {
        $paginate   =   $bookingPaginateRequest->validated();
        return new BookingCollection($this->bookingService->getByUserId($userId,$paginate[BookingContract::PAGINATE]));
    }

    public function getByOrganizationId($organizationId, BookingPaginateRequest $request):object
    {
        $booking    =   $this->bookingService->getByOrganizationId($organizationId, $request->validated()[BookingContract::PAGINATE]);
        return new BookingCollection($booking);
    }

    public function getByTableId($tableId, BookingPaginateRequest $bookingPaginateRequest):object
    {
        $data   =   $bookingPaginateRequest->validated();
        return new BookingCollection($this->bookingService->getByTableId($tableId, $data[BookingContract::PAGINATE]));
    }

    public function getByDate($date, BookingPaginateRequest $bookingPaginateRequest):object
    {
        $data   =   $bookingPaginateRequest->validated();
        return new BookingCollection($this->bookingService->getByDate($date, $data[BookingContract::PAGINATE]));
    }

    public function guest(BookingGuestRequest $bookingGuestRequest)
    {
        $data   =   $bookingGuestRequest->validated();
        $user   =   $this->userService->getById($data[BookingContract::USER_ID]);
        if ($user->{UserContract::CODE} !== $data[BookingContract::CODE]) {
            return response([
                MainContract::MESSAGE  =>  'Не правильный код'
            ],400);
        }
        $user->{UserContract::PHONE_VERIFIED_AT}    =   date('Y-m-d H:i:s');
        $user->save();
        $booking    =   $this->bookingService->create($data);

        if ($booking->{BookingContract::PRICE} > 0) {

            $payment    =   $this->paymentService->urlAdmin(
                $booking->{BookingContract::ID},
                $booking->{BookingContract::PRICE},
                $data[BookingContract::TITLE],
                $user->{UserContract::PHONE}
            );

            if (array_key_exists(PaymentContract::PG_REDIRECT_URL,$payment)) {
                $booking->{BookingContract::PAYMENT_URL}    =   $payment[PaymentContract::PG_REDIRECT_URL];
                $booking->save();
            }
        }

        return new BookingResource($booking);
    }

}
