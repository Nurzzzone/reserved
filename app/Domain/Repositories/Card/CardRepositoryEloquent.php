<?php


namespace App\Domain\Repositories\Card;

use App\Models\Card;
use App\Domain\Contracts\CardContract;

class CardRepositoryEloquent implements CardRepositoryInterface
{
    public function create(array $input)
    {
        return Card::create($input);
    }

    public function update($id, array $input):void
    {
        if (array_key_exists(CardContract::ID,$input)) {
            unset($input[CardContract::ID]);
        }
        Card::where(CardContract::ID,$id)->update($input);
    }

    public function delete($id)
    {
        Card::where(CardContract::ID,$id)->update([
            CardContract::STATUS    =>  CardContract::OFF
        ]);
    }

    public function getById($id)
    {
        return Card::where([
            [CardContract::ID,$id],
            [CardContract::STATUS,CardContract::ON]
        ])->first();
    }

    public function getByUserId($userId)
    {
        return Card::where([
            [CardContract::USER_ID,$userId],
            [CardContract::STATUS,CardContract::ON]
        ])->get();
    }

}
