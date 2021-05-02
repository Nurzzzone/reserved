<?php


namespace App\Services\Sms;

use App\Services\BaseService;

class SmsService extends BaseService
{

    protected $login    =   'sms_api';
    protected $password =   'Qwerty000';
    protected $url      =   'https://smsc.kz/sys/send.php';
    protected $code;
    protected $userPassword;
    protected $userPhone;


    public function sendCode(string $phone, int $code)
    {
        $this->code =   $code;
        $ch =   curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.'?'.$this->getParameters($phone));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $exec   =   curl_exec($ch);
        curl_close($ch);
        return $exec;
    }

    public function sendUser(string $phone, string $password)
    {
        $this->userPhone    =   $phone;
        $this->userPassword =   $password;
        $ch =   curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.'?'.$this->getUserParameters($phone));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $exec   =   curl_exec($ch);
        curl_close($ch);
        return $exec;
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

    public function messageUser():string
    {
        return 'Дбро пожаловать в reserved.kz\n Ваш логин: '.$this->userPhone.'\n Ваш пароль: '.$this->userPassword;
    }

    public function getParameters(string $phone):string
    {
        return http_build_query([
            'login'     =>  $this->login,
            'psw'       =>  $this->password,
            'phones'    =>  $phone,
            'mes'       =>  $this->message()
        ]);
    }

    public function message():string
    {
        return 'Ваш код: '.$this->code.' для подтверждения регистрации';
    }

}
