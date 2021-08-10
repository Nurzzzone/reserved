<?php


namespace App\Helpers\Sms;

use App\Domain\Contracts\UserContract;
use App\Models\User;
use App\Helpers\Curl\Curl;

class Sms
{
    protected $link     =   'https://reserved-app.kz';
    protected $login    =   'An-technology';
    protected $password =   'ygABGazD55XJ4NcesmBo';
    protected $url      =   'https://smsc.kz/sys/send.php';
    protected $curl;

    public function __construct(Curl $curl)
    {
        $this->curl =   $curl;
    }

    public function code(User $user):void
    {
        $this->curl->get($this->url.'?'.$this->parameters([
            'phones'    =>  $user->{UserContract::PHONE},
            'mes'       =>  $_SERVER['SERVER_NAME'].' Ваш код: '.$user->{UserContract::CODE}
        ]));
    }

    public function password(User $user, string $password):void
    {
        $this->curl->get($this->url.'?'.$this->parameters([
            'phones'    =>  $user->{UserContract::PHONE},
            'mes'       =>  $_SERVER['SERVER_NAME'].' ваш пароль: '.$password.' для входа, никому не сообщайте'
        ]));
    }

    public function parameters(array $data): string
    {
        $arr    =   array_merge([
            'login' =>  $this->login,
            'psw'   =>  $this->password,
        ],$data);
        return http_build_query($arr);
    }

}
