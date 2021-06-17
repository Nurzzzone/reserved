<?php


namespace App\Services\Card;

use App\Services\BaseService;
use App\Domain\Repositories\Card\CardRepositoryInterface;

class CardService extends BaseService
{
    protected $cardRepository;
    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository   =   $cardRepository;
    }

    public function create(array $request)
    {
        return $this->cardRepository->create($request);
    }

}
