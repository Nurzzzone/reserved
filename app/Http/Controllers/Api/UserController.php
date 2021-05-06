<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Services\Sms\SmsService;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;
    protected $smsService;
    public function __construct(UserService $userService, SmsService $smsService)
    {
        $this->userService  =   $userService;
        $this->smsService   =   $smsService;
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
        $user   =   $this->userService->getByPhoneAndPassword($phone,$password);
        if ($user) {
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
