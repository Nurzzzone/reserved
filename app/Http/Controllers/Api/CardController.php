<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Card\CardService;
use App\Domain\Contracts\MainContract;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    protected $cardService;
    public function __construct(CardService $cardService)
    {
        $this->cardService  =   $cardService;
    }

    public function post(Request $request)
    {
        if ($request->has(MainContract::PG_XML)) {
            $xml    =   json_decode(json_encode(simplexml_load_string($request->input(MainContract::PG_XML))),true);
            Log::info('This is some useful information.', $xml);
        }
        /*
         //{"pg_xml":}
        "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <response>
                <pg_payment_id>490497051</pg_payment_id>
                <pg_order_id/>
                <pg_card_hash>4263-43XX-XXXX-9479</pg_card_hash>
                <pg_card_hhash>3efd4bd7573e44747c946768db4349e4</pg_card_hhash>
                <pg_card_month>02</pg_card_month>
                <pg_card_year>26</pg_card_year>
                <pg_bank>АО \"Сбербанк\"</pg_bank>
                <pg_country>KZ</pg_country>
                <pg_card_3ds>1</pg_card_3ds>
                <pg_status>success</pg_status>
                <pg_card_id>34249163</pg_card_id>
                <pg_user_id>1</pg_user_id>
                <pg_recurring_profile_id/>
                <pg_type>approve</pg_type>
                <pg_salt>FuMiBicv</pg_salt>
                <pg_sig>4b34eee86fa732c1d21d17ef22d4652c</pg_sig>
                </response>";
         */
    }
}
