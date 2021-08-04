<?php

namespace App\Services\TelegramChat;

use App\Services\BaseService;
use App\Domain\Repositories\TelegramChat\TelegramChatRepositoryInterface;

class TelegramChatService extends BaseService
{
    protected $telegramChatRepository;
    public function __construct(TelegramChatRepositoryInterface $telegramChatRepository)
    {
        $this->telegramChatRepository   =   $telegramChatRepository;
    }

    public function create($data)
    {
        return $this->telegramChatRepository->create($data);
    }

    public function getByTelegramId($telegramId)
    {
        return $this->telegramChatRepository->getByTelegramId($telegramId);
    }

    public function getByChatId($chatId)
    {
        return $this->telegramChatRepository->getByChatId($chatId);
    }

    public function update($chatId,$data)
    {
        $this->telegramChatRepository->update($chatId,$data);
    }

}
