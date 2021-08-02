<?php

namespace App\Services\Telegram;

use App\Services\BaseService;
use App\Domain\Repositories\Telegram\TelegramRepositoryInterface;

class TelegramService extends BaseService
{
    protected $telegramRepository;
    public function __construct(TelegramRepositoryInterface $telegramRepository)
    {
        $this->telegramRepository   =   $telegramRepository;
    }

    public function getByUserId($userId)
    {
        return $this->telegramRepository->getByUserId($userId);
    }

    public function getById($id)
    {
        return $this->telegramRepository->getById($id);
    }

}
