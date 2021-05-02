<?php


namespace App\Services\Api;

use App\Services\BaseService;
use App\Domain\Repositories\User\UserRepositoryInterface;

class ApiService extends BaseService
{
    const USER_ID       =   'api25';
    const USER_SECRET   =   'Qwerty00';
    const PATH          =   'https://iiko.biz:9900';
    const API           =   '/api/0';
    const URL           =   self::PATH.self::API.'/auth/access_token?user_id='.self::USER_ID.'&user_secret='.self::USER_SECRET;
    const URL_ORDER     =   self::PATH.self::API.'/orders/add';
    public $token;
    protected $user;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->token    =   $this->getToken();
        $this->user     =   $userRepository;
    }

    public function createOrder()
    {
        $url    =   self::URL_ORDER.'?access_token='.$this->token.'&request_timeout=15';
    }

    public function getToken()
    {
        return $this->curlGet(self::URL);
    }

    public function curlGet(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
