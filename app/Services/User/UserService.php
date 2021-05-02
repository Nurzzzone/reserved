<?php


namespace App\Services\User;

use App\Services\BaseService;
use App\Domain\Repositories\User\UserRepositoryEloquent as UserRepository;

class UserService extends BaseService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository   =   $userRepository;
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function verifyCode(int $code):bool
    {
        if ((int) backpack_user()->code === $code) {
            return $this->userRepository->updatePhoneVerifiedAt();
        }
        return false;
    }
}
