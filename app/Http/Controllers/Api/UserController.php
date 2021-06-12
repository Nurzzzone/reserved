<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\UserContract;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Services\User\UserService;
use App\Services\Sms\SmsService;
use App\Services\Booking\BookingService;

use App\Http\Resources\UserResource;

use App\Jobs\BookingPayment;
use App\Jobs\UserPassword;

class UserController extends Controller
{

    protected $userService;
    protected $smsService;
    protected $bookingService;

    public function __construct(UserService $userService, SmsService $smsService, BookingService $bookingService)
    {
        $this->userService  =   $userService;
        $this->smsService   =   $smsService;
        $this->bookingService   =   $bookingService;
    }

    public function booking(Request $request)
    {
        $user   =   $this->userService->getByPhone($request->input(UserContract::PHONE));

        if (!$user) {
            $password   =   Str::random(8);
            $user   =   $this->userService->adminCreate([
                UserContract::USER_ID   =>  $request->input(UserContract::USER_ID),
                UserContract::NAME  =>  $request->input(UserContract::NAME),
                UserContract::PHONE =>  $request->input(UserContract::PHONE),
                UserContract::PASSWORD  =>  $password
            ]);
            UserPassword::dispatch([$user->{UserContract::PHONE},$password]);
        }

        $time   =   new \DateTime(date('Y-m-d').' '.$request->input(BookingContract::TIME), new \DateTimeZone($request->input(BookingContract::TIMEZONE)));
        $time->setTimezone(new \DateTimeZone(BookingContract::UTC));

        $booking    =   $this->bookingService->create([
            BookingContract::USER_ID    =>  $user->{UserContract::ID},
            BookingContract::ORGANIZATION_ID    =>  $request->input(BookingContract::ORGANIZATION_ID),
            BookingContract::ORGANIZATION_TABLE_ID  =>  $request->input(BookingContract::ORGANIZATION_TABLE_ID),
            BookingContract::TIME   =>  $time->format('H:i:s'),
            BookingContract::DATE   =>  $request->input(BookingContract::DATE),
            BookingContract::COMMENT    =>  $request->input(BookingContract::COMMENT)
        ]);

        BookingPayment::dispatch([$booking->id,$request->input(BookingContract::ORGANIZATION_ID),$user->{UserContract::ID}]);

        return $booking;
    }

    public function getByPhone($phone)
    {
        $user   =   $this->userService->getByPhone($phone);
        if ($user) {
            return new UserResource($user);
        }
        return response(['message'  =>  'Пользователь не найден'],404);
    }

    public function getById($id)
    {
        $user   =   $this->userService->getById($id);
        if ($user) {
            return new UserResource($user);
        }
        return response(['message'  =>  'Пользователь не найден'],404);
    }

    public function smsVerify($phone,$code)
    {
        $user   =   $this->userService->smsVerify($phone,$code);
        if ($user) {
            return new UserResource($user);
        }
        return response(['message'  =>  'incorrect code'],400);
    }

    public function smsResend($phone)
    {
        $user   =   $this->userService->smsResend($phone);
        if ($user) {
            $this->smsService->sendCode($user->phone,$user->code);
            return new UserResource($user);
        }
        return response(['message'  =>  'Phone doesn\'t exist'],400);
    }

    public function token($token)
    {
        $user   =   $this->userService->getByApiToken($token);
        if ($user) {
            return new UserResource($user);
        }
        return response(['message'  =>  'token expired'],404);
    }

    public function login(string $phone, string $password)
    {
        $user   =   $this->userService->getByPhoneAndPassword($phone);
        if ($user && Hash::check($password,$user->password)) {
            return new UserResource($user);
        }
        return response(['message'  =>  'incorrect phone or password'],401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            UserContract::NAME  =>  'required|min:2|max:255',
            UserContract::PHONE     =>  'required|max:255|unique:users',
            UserContract::PASSWORD  =>  'required|min:8',
        ]);

        if ($validator->fails()) {
            $message    =   '';
            if ($validator->messages()->first(UserContract::NAME)) {
                $message    =   $validator->messages()->first(UserContract::NAME);
            } elseif ($validator->messages()->first(UserContract::PHONE)) {
                $message    =   $validator->messages()->first(UserContract::PHONE);
            } elseif ($validator->messages()->first(UserContract::PASSWORD)) {
                $message    =   $validator->messages()->first(UserContract::PASSWORD);
            }
            return response(['message'  =>  $message],400);
        }
        $user   =   $this->userService->create($request->all());
        $this->smsService->sendCode($user->phone,$user->code);
        return new UserResource($user);
    }
}
