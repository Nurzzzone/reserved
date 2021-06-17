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

    public function create(array $input)
    {
        return $this->cardRepository->create($input);
    }

    public function update($id, array $input):void
    {
        $this->cardRepository->update($id, $input);
    }

    public function delete($id)
    {
        $this->cardRepository->delete($id);
    }

    public function getById($id)
    {
        return $this->cardRepository->getById($id);
    }

    public function getByUserId($userId):array
    {
        return $this->cardRepository->getByUserId($userId);
    }

}
