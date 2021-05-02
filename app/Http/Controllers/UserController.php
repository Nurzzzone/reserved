<?php

namespace App\Http\Controllers;

use App\Domain\Contracts\UserContract;
use App\Http\Requests\SmsCodeRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $home =   'admin/dashboard';
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService  =   $userService;
    }


    public function phoneVerify()
    {
        return view('phone_verify');
    }

    public function blockedUser()
    {
        return view('blocked_user');
    }

    public function checkPhoneCode(SmsCodeRequest $request)
    {
        $code   =   $request->input(UserContract::CODE);
        $userId =   backpack_user()->id;
        if ($this->userService->verifyCode($code)) {
            return redirect($this->home);
        } else {
            throw ValidationException::withMessages([
                UserContract::CODE  =>  [trans('backpack::base.incorrect_code')],
            ]);
        }
    }
}
