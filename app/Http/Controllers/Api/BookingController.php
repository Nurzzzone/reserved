<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\BookingContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use Illuminate\Http\Request;
use App\Services\Booking\BookingService;
use App\Http\Resources\BookingCollection;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected $bookingService;
    protected $paginate =   1;
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService   =   $bookingService;
    }

    public function getByUserId($id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new BookingCollection($this->bookingService->getByUserId($id,$this->paginate));
    }

    public function tables($id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new BookingCollection($this->bookingService->getByTableId($id,$this->paginate));
    }

    public function getByOrganizationId($id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new BookingCollection($this->bookingService->getByOrganizationId($id,$this->paginate));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            BookingContract::USER_ID    =>  'required|exists:App\Models\User,id',
            BookingContract::ORGANIZATION_ID    =>  'required',
            BookingContract::ORGANIZATION_TABLE_ID  =>  'required|exists:App\Models\OrganizationTableList,id',
            BookingContract::START  =>  'required|string',
            BookingContract::END    =>  'required|string',
            BookingContract::DATE   =>  'required|date',
            BookingContract::PHONE  =>  'nullable|string',
            BookingContract::COMMENT    =>  'nullable|string',
            BookingContract::STATUS =>  'required|string'
        ]);
        if ($validator->fails()) {
            $message    =   '';
            if ($validator->messages()->first(BookingContract::USER_ID)) {
                $message    =   $validator->messages()->first(BookingContract::USER_ID);
            } elseif ($validator->messages()->first(BookingContract::ORGANIZATION_ID)) {
                $message    =   $validator->messages()->first(BookingContract::ORGANIZATION_ID);
            } elseif ($validator->messages()->first(BookingContract::ORGANIZATION_TABLE_ID)) {
                $message    =   $validator->messages()->first(BookingContract::ORGANIZATION_TABLE_ID);
            } elseif ($validator->messages()->first(BookingContract::START)) {
                $message    =   $validator->messages()->first(BookingContract::START);
            } elseif ($validator->messages()->first(BookingContract::END)) {
                $message    =   $validator->messages()->first(BookingContract::END);
            } elseif ($validator->messages()->first(BookingContract::DATE)) {
                $message    =   $validator->messages()->first(BookingContract::DATE);
            } elseif ($validator->messages()->first(BookingContract::PHONE)) {
                $message    =   $validator->messages()->first(BookingContract::PHONE);
            } elseif ($validator->messages()->first(BookingContract::COMMENT)) {
                $message    =   $validator->messages()->first(BookingContract::COMMENT);
            } elseif ($validator->messages()->first(BookingContract::STATUS)) {
                $message    =   $validator->messages()->first(BookingContract::STATUS);
            }
            return response(['message'  =>  $message],400);
        }
        return new BookingResource($this->bookingService->create($request->all()));
    }
}
