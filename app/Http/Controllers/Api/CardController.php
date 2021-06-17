<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Card\CardService;
use App\Services\Payment\PaymentService;

use App\Domain\Contracts\MainContract;
use App\Domain\Contracts\CardContract;

use Illuminate\Support\Facades\Log;

use App\Http\Requests\Card\CardPostRequest;
use App\Http\Requests\Card\CardUpdateRequest;

use App\Jobs\CardDelete;

class CardController extends Controller
{
    protected $cardService;
    protected $paymentService;
    public function __construct(CardService $cardService, PaymentService $paymentService)
    {
        $this->cardService  =   $cardService;
        $this->paymentService   =   $paymentService;
    }

    public function post(CardPostRequest $request)
    {
        $request    =   $request->validated();
        $xml    =   json_decode(json_encode(simplexml_load_string($request[MainContract::PG_XML])),true);
        if ($xml && array_key_exists(MainContract::PG_STATUS,$xml) && ($xml[MainContract::PG_STATUS] === MainContract::SUCCESS)) {
            $this->cardService->create([
                CardContract::USER_ID   =>  $xml[MainContract::PG_USER_ID],
                CardContract::CARD_ID   =>  $xml[MainContract::PG_CARD_ID],
                CardContract::HASH      =>  $xml[MainContract::PG_CARD_HASH],
                CardContract::MONTH     =>  $xml[MainContract::PG_CARD_MONTH],
                CardContract::YEAR      =>  $xml[MainContract::PG_CARD_YEAR],
                CardContract::BANK      =>  $xml[MainContract::PG_BANK],
                CardContract::COUNTRY   =>  $xml[MainContract::PG_COUNTRY],
                CardContract::CARD_3D   =>  $xml[MainContract::PG_CARD_3DS],
            ]);
        }
    }

    public function update($id, CardUpdateRequest $request)
    {
        $this->cardService->update($id, $request->validated());
        if ($card   =   $this->cardService->getById($id)) {
            return $card;
        }
        return response(['message'  =>  'Card Not Found'],400);
    }

    public function delete($id)
    {
        if ($card   =   $this->cardService->getById($id)) {
            $this->cardService->delete($id);
            CardDelete::dispatch($card);
            return response(['message'  =>  'Card Deleted'],200);
        }
        return response(['message'  =>  'Card Not Found'],400);
    }

    public function getById($id)
    {
        if ($card   =   $this->cardService->getById($id)) {
            return $card;
        }
        return response(['message'  =>  'Card Not Found'],400);
    }

    public function getByUserId($userId)
    {
        return $this->cardService->getByUserId($userId);
    }
}
