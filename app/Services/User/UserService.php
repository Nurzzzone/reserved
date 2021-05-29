<?php


namespace App\Services\User;

use App\Services\BaseService;
use App\Domain\Repositories\User\UserRepositoryInterface;

class UserService extends BaseService
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository   =   $userRepository;
    }

    public function create(array $data) {
        return $this->userRepository->create($data);
    }

    public function smsVerify($phone,$code) {
        return $this->userRepository->smsVerify($phone,$code);
    }

    public function getById(int $id) {
        return $this->userRepository->getById($id);
    }

    public function getByApiToken(string $token) {
        return $this->userRepository->getByApiToken($token);
    }

    public function getByPhoneAndPassword($phone) {
        return $this->userRepository->getByPhoneAndPassword($phone);
    }

    public function verifyCode(int $code) {
        if ((int) backpack_user()->code === $code) {
            return $this->userRepository->updatePhoneVerifiedAt();
        }
        return false;
    }
}
