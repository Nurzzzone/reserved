<?php


namespace App\Domain\Repositories\User;

use App\Domain\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Str;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return  User::create([
            UserContract::USER_ID   =>  array_key_exists(UserContract::USER_ID,$data)?$data[UserContract::NAME]:null,
            UserContract::NAME      =>  $data[UserContract::NAME],
            UserContract::PHONE     =>  $data[UserContract::PHONE],
            UserContract::CODE      =>  rand(100000,999999),
            UserContract::PASSWORD  =>  $data[UserContract::PASSWORD],
            UserContract::API_TOKEN =>  Str::random(60)
        ]);
    }

    public function updatePhoneVerifiedAt()
    {
        $user   =   backpack_user();
        $user->phone_verified_at    =   date('Y-m-d G:i:s');
        return $user->save();
    }

    public function getById(int $id)
    {
        return User::where(UserContract::ID,$id)->first();
    }

    public function getByPhoneAndPassword($phone,$password)
    {
        return User::where([[UserContract::PHONE,$phone],[UserContract::PASSWORD,bcrypt($password)]])->first();
    }

    public function getByApiToken(string $token)
    {
        return User::where(UserContract::API_TOKEN,$token)->first();
    }
}
