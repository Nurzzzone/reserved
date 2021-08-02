<?php

namespace App\Helpers\Telegram;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\TelegramContract;
use App\Domain\Contracts\UserContract;
use App\Helpers\Curl\Curl;
use App\Services\User\UserService;

class Telegram
{
    protected $curl;
    protected $userService;
    public function __construct(Curl $curl, UserService $userService)
    {
        $this->curl =   $curl;
        $this->userService  =   $userService;
    }

    public function booking($telegrams, $booking)
    {
        foreach ($telegrams as &$telegram) {
            if ($telegram->{TelegramContract::STATUS}   === TelegramContract::ALL || $telegram->{TelegramContract::STATUS}   === TelegramContract::BOOKINGS) {
                $chatIds    =   $this->getChatIds($telegram);
                foreach ($chatIds as &$chatId) {
                    $this->send($telegram, $chatId, $booking);
                }
            }
        }
    }

    public function getChatIds($telegram)
    {
        $arr        =   [];
        $chatIds    =   json_decode($this->curl->getSend($this->urlUpdates($telegram)),true);
        if (array_key_exists('result', $chatIds)) {
            foreach ($chatIds['result'] as &$chatId) {
                $arr[]  =   $chatId['message']['chat']['id'];
            }
        }
        return array_unique($arr);
    }

    public function send($telegram, $chatId, $booking)
    {
        $this->curl->postSend($this->urlMessage($telegram),[
            'chat_id'   =>  $chatId,
            'text'      =>  $this->bookingText($booking)
        ]);
    }

    public function bookingText($booking)
    {
        $user   =   $this->userService->getById($booking->{BookingContract::USER_ID});
        $booking    =   'Бронирование №'.$booking->{BookingContract::ID}.'\r\n';
        $booking    .=  'Стол: '.$booking->{BookingContract::ORGANIZATION_TABLE_LIST_ID}.'\r\n';
        $booking    .=  'Время: '.$booking->{BookingContract::TIME}.' '.$booking->{BookingContract::TIME}.'\r\n';
        $booking    .=  'Имя: '.$user->{UserContract::NAME}.'\r\n';
        $booking    .=  'Телефон: '.$user->{UserContract::PHONE};
        return $booking;
    }

    public function urlMessage($telegram)
    {
        return 'https://api.telegram.org/bot'.$telegram->{TelegramContract::API_TOKEN}.'/sendMessage';
    }

    public function urlUpdates($telegram)
    {
        return 'https://api.telegram.org/bot'.$telegram->{TelegramContract::API_TOKEN}.'/getUpdates';
    }

}
