<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\TelegramChatContract;
use App\Domain\Contracts\TelegramContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\Telegram\TelegramResource;
use App\Models\TelegramChat;
use Illuminate\Http\Request;
use App\Services\Telegram\TelegramService;

use App\Http\Resources\Telegram\TelegramCollection;

use App\Http\Requests\Telegram\TelegramWebhookRequest;
use App\Services\TelegramChat\TelegramChatService;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    protected $telegramService;
    protected $telegramChatService;
    public function __construct(TelegramService $telegramService, TelegramChatService $telegramChatService)
    {
        $this->telegramService  =   $telegramService;
        $this->telegramChatService  =   $telegramChatService;
    }

    public function getByUserId($userId)
    {
        return new TelegramCollection($this->telegramService->getByUserId($userId));
    }

    public function getById($id)
    {
       if ($telegram   =   $this->telegramService->getById($id)) {
           return new TelegramResource($telegram);
       }
        return response(['message'  =>  'Телеграм не найден'],404);
    }

    public function webhook($id, TelegramWebhookRequest $telegramWebhookRequest)
    {
        $data   =   $telegramWebhookRequest->validated()[TelegramContract::MESSAGE];
        $chat   =   $data[TelegramContract::CHAT][TelegramContract::ID];
        if (!$telegramChat = $this->telegramChatService->getByTelegramId($id)) {
            $telegramChat   =   $this->telegramChatService->create([
                TelegramChatContract::TELEGRAM_ID   =>  $id,
                TelegramChatContract::TELEGRAM_CHAT_ID  =>  $chat,
            ]);
        } elseif (array_key_exists(TelegramContract::TEXT,$data)) {
            if ($data[TelegramContract::TEXT] === '/start') {
                $this->telegramChatService->update($chat,[
                    TelegramContract::STATUS    =>  TelegramContract::ON
                ]);
            }
        }

    }

}
