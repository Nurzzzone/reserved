<?php


namespace App\Services\Sms;

use App\Services\BaseService;
use App\Helpers\Curl\Curl;

class SmsService extends BaseService
{

    protected $login    =   'amantur7';
    protected $password =   'qwerty00';
    protected $url      =   'https://smsc.kz/sys/send.php';
    protected $code;
    protected $userPassword;
    protected $userPhone;
    protected $curl;

    public function __construct(Curl $curl) {
        $this->curl =   $curl;
    }

    public function sendBooking(string $phone, string $detail, string $link) {
        return $this->curl->get($this->url.'?'.$this->getPaymentParameters($phone,$detail,$link));
    }

    public function sendCode(string $phone, int $code) {
        $this->code =   $code;
        return $this->curl->get($this->url.'?'.$this->getParameters($phone));
    }

    public function sendUser(string $phone, string $password) {
        $this->userPhone    =   $phone;
        $this->userPassword =   $password;
        return $this->curl->get($this->url.'?'.$this->getUserParameters($phone));
    }

    public function getPaymentParameters($phone,$detail,$link) {
        return http_build_query([
            'login'     =>  $this->login,
            'psw'       =>  $this->password,
            'phones'    =>  $phone,
            'mes'       =>  $this->messagePayment($detail,$link)
        ]);
    }

    public function getUserParameters(string $phone):string
    {
        return http_build_query([
            'login'     =>  $this->login,
            'psw'       =>  $this->password,
            'phones'    =>  $phone,
            'mes'       =>  $this->messageUser()
        ]);
    }

    public function getParameters(string $phone):string {
        return http_build_query([
            'login'     =>  $this->login,
            'psw'       =>  $this->password,
            'phones'    =>  $phone,
            'mes'       =>  $this->message()
        ]);
    }

    public function messagePayment($detail,$link):string {
        return 'Вы забронировали стол в '.$detail.', для подтверждения бронирование пройдите по этой ссылке '.$link;
    }

    public function messageUser():string {
        return 'Добро пожаловать в reserved.kz\n Ваш логин: '.$this->userPhone.'\n Ваш пароль: '.$this->userPassword;
    }

    public function message():string {
        return 'Ваш код: '.$this->code.' для подтверждения регистрации';
    }

}
