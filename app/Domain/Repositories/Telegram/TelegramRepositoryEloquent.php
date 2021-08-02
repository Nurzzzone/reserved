<?php

namespace App\Domain\Repositories\Telegram;

use App\Domain\Contracts\TelegramContract;
use App\Models\Telegram;

class TelegramRepositoryEloquent implements TelegramRepositoryInterface
{
    public function create($data)
    {
        return Telegram::create($data);
    }

    public function update($id, $data)
    {
        Telegram::where(TelegramContract::ID,$id)->update($data);
        return $this->getById($id);
    }

    public function getByUserId($userId)
    {
        return Telegram::where([
            [TelegramContract::USER_ID,$userId],
            [TelegramContract::STATUS,'!=',TelegramContract::OFF]
        ])->get();
    }

    public function getById($id)
    {
        return Telegram::where([
            [TelegramContract::ID,$id],
            [TelegramContract::STATUS,'!=',TelegramContract::OFF]
        ])->first();
    }

}
