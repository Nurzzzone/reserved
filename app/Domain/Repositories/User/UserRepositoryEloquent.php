<?php


namespace App\Domain\Repositories\User;

use App\Domain\Contracts\UserContract;
use App\Models\User;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return  User::create([
            UserContract::USER_ID   =>  array_key_exists(UserContract::USER_ID,$data)?$data[UserContract::NAME]:null,
            UserContract::NAME      =>  $data[UserContract::NAME],
            UserContract::PHONE     =>  $data[UserContract::PHONE],
            UserContract::CODE      =>  rand(100000,999999),
            UserContract::PASSWORD  =>  bcrypt($data[UserContract::PASSWORD]),
        ]);
    }

    public function updatePhoneVerifiedAt()
    {
        $user   =   backpack_user();
        $user->phone_verified_at    =   date('Y-m-d G:i:s');
        return $user->save();
    }
}
