<?php


namespace App\Domain\Repositories\Card;

use App\Models\Card;
use App\Domain\Contracts\CardContract;

class CardRepositoryEloquent implements CardRepositoryInterface
{
    public function create(array $request)
    {
        return Card::create($request);
    }
}
