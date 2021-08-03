<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Telegram\TelegramResource;
use Illuminate\Http\Request;
use App\Services\Telegram\TelegramService;

use App\Http\Resources\Telegram\TelegramCollection;

use App\Http\Requests\Telegram\TelegramWebhookRequest;

use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    protected $telegramService;
    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService  =   $telegramService;
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

    public function webhook(TelegramWebhookRequest $telegramWebhookRequest)
    {
        Log::info('telegram',$telegramWebhookRequest->validated());
    }
}
