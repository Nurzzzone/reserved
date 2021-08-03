<?php

namespace App\Domain\Repositories\TelegramChat;

use App\Models\TelegramChat;
use App\Domain\Contracts\TelegramChatContract;

class TelegramChatRepositoryEloquent implements TelegramChatRepositoryInterface
{
    public function create($data)
    {
        return TelegramChat::create($data);
    }

    public function getByTelegramId($telegramId)
    {
        return TelegramChat::where([
            [TelegramChatContract::ID,$telegramId],
            [TelegramChatContract::STATUS,TelegramChatContract::ON]
        ])->get();
    }

    public function update($chatId,$data)
    {
        TelegramChat::where(TelegramChatContract::TELEGRAM_CHAT_ID,$chatId)->update($data);
    }


}
