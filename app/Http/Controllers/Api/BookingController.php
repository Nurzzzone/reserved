<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;

use App\Services\Booking\BookingService;
use App\Services\Payment\PaymentService;
use App\Services\Organization\OrganizationService;
use App\Services\User\UserService;

use App\Http\Requests\BookingCreateRequest;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationContract;

class BookingController extends Controller
{
    protected $bookingService;
    protected $paymentService;
    protected $organizationService;
    protected $userService;
    protected $paginate =   1;

    public function __construct(BookingService $bookingService, PaymentService $paymentService, OrganizationService $organizationService, UserService $userService) {
        $this->bookingService   =   $bookingService;
        $this->paymentService   =   $paymentService;
        $this->organizationService  =   $organizationService;
        $this->userService      =   $userService;
    }

    public function getByUserId($id, Request $request) {
        if ($request->has(BookingContract::PAGINATE)) {
            $this->paginate =   (int)$request->input(BookingContract::PAGINATE);
        }
        return new BookingCollection($this->bookingService->getByUserId($id,$this->paginate));
    }

    public function tables($id, Request $request) {
        if ($request->has(BookingContract::PAGINATE)) {
            $this->paginate =   (int)$request->input(BookingContract::PAGINATE);
        }
        return new BookingCollection($this->bookingService->getByTableId($id,$this->paginate));
    }

    public function getByOrganizationId($id, Request $request) {
        if ($request->has(BookingContract::PAGINATE)) {
            $this->paginate =   (int)$request->input(BookingContract::PAGINATE);
        }
        return new BookingCollection($this->bookingService->getByOrganizationId($id,$this->paginate));
    }

    public function add(BookingCreateRequest $request) {
        $request        =   $request->validated();
        $organization   =   DB::table(OrganizationContract::TABLE)
            ->where(OrganizationContract::ID, $request[BookingContract::ORGANIZATION_ID])
            ->first();
        $user           =   $this->userService->getById($request[BookingContract::USER_ID]);
        $booking        =   $this->bookingService->create($request);
        $payment        =   $this->paymentService->urlAdmin(
            $booking->id,
            $organization->price,
            $organization->title,
            $user->phone,
        );
        $booking->{BookingContract::URL} =   $payment[BookingContract::PG_REDIRECT_URL];
        return $booking;
    }
}
