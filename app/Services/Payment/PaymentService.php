<?php


namespace App\Services\Payment;

use App\Domain\Repositories\Payment\PaymentRepositoryInterface;
use App\Domain\Contracts\PaymentContract;
use App\Helpers\Curl\Curl;

class PaymentService
{
    protected $paymentRepository;
    protected $curl;
    const ID    =   538109;
    const SITE  =   'http://reserved.org.kz';
    const URL   =   'https://api.paybox.money';
    const PHONE =   '+77021366697';
    const EMAIL =   'antechnology@bk.ru';
    const KEY   =   'UVwuMp4af1xBXYCe';
    const PKEY  =   'y3rB2e9V8XGcTlgO';
    const INIT  =   'init_payment.php';

    const STATUS    =   'get_status.php';
    const MAIN_URL  =   self::URL.'/'.self::INIT;
    const PAY_URL   =   self::URL.'/'.self::STATUS;

    const CARD_ADD  =   self::URL.'/v1/merchant/'.self::ID.'/cardstorage/add';
    const CARD_LIST =   self::URL.'/v1/merchant/'.self::ID.'/cardstorage/list';

    const CARD_POST =   self::SITE.'/api/payment/card/post';
    const CARD_BACK =   self::SITE.'/api/payment/card/back';
    const CURRENCY  =   'KZT';
    const CHECK_URL =   self::SITE.'/api/payment/check';
    const POST_URL  =   self::SITE.'/api/payment/post';
    const STATE_URL =   self::SITE.'/state';
    const LIFETIME  =   86400;
    const LANGUAGE  =   'ru';

    const RESULT_URL    =   self::SITE.'/api/payment/result';
    const SUCCESS_URL   =   self::SITE.'/api/payment/success';
    const FAILURE_URL   =   self::SITE.'/api/payment/failure';
    const RETURN_URL    =   self::SITE.'/return';
    const PAYMENT_ROUTE =   'frame';

    const PAYMENT_SYSTEM    =   'EPAYWEBKZT';

    const RECURRING_LIFETIME    =   156;

    public function __construct(PaymentRepositoryInterface $paymentRepository, Curl $curl) {
        $this->paymentRepository    =   $paymentRepository;
        $this->curl =   $curl;
    }

    public function create($data) {
        return $this->paymentRepository->create($data);
    }

    public function url($id, $price, $description, $userId, $cardId) {
        return self::MAIN_URL.'?'.http_build_query($this->params($id, $price, $description, $userId, $cardId));
    }

    public function urlAdmin($id, $price, $description, $userId, $phone) {
        $xml    =   $this->curl->post(self::MAIN_URL,$this->signature([
            PaymentContract::PG_ORDER_ID    =>  $id,
            PaymentContract::PG_MERCHANT_ID =>  self::ID,
            PaymentContract::PG_AMOUNT      =>  $price,
            PaymentContract::PG_DESCRIPTION =>  $description,
            PaymentContract::PG_SALT        =>  rand(100000,999999),
            PaymentContract::PG_USER_ID     =>  $userId,
            PaymentContract::PG_RESULT_URL  =>  self::RESULT_URL,
            PaymentContract::PG_REQUEST_METHOD  =>  PaymentContract::GET,
            PaymentContract::PG_SUCCESS_URL =>  self::SUCCESS_URL,
            PaymentContract::PG_FAILURE_URL =>  self::FAILURE_URL,
            PaymentContract::PG_SUCCESS_URL_METHODS => PaymentContract::GET,
            PaymentContract::PG_FAILURE_URL_METHODS => PaymentContract::GET,
            PaymentContract::PG_USER_PHONE  =>  $phone
        ]));
        return json_decode(json_encode(simplexml_load_string($xml)),true);
    }

    public function cardList($userId) {
        return $this->curl->post(self::CARD_LIST, $this->signature([
            PaymentContract::PG_USER_ID =>  $userId,
            PaymentContract::PG_SALT    =>  rand(100000,999999),
            PaymentContract::PG_MERCHANT_ID =>  self::ID,
        ]));
    }

    public function cardAdd($userId) {
        return $this->curl->post(self::CARD_ADD, $this->signature([
            PaymentContract::PG_USER_ID =>  $userId,
            PaymentContract::PG_SALT    =>  rand(100000,99999),
            PaymentContract::PG_MERCHANT_ID =>  self::ID,
            PaymentContract::PG_POST_LINK   =>  self::CARD_POST,
            PaymentContract::PG_BACK_LINK   =>  self::CARD_BACK,

        ]));
    }

    public function params($id, $price, $description, $userId, $cardId) {
        return $this->signature([
            PaymentContract::PG_AMOUNT  =>  $price,
            PaymentContract::PG_SALT    =>  rand(100000,99999),
            PaymentContract::PG_USER_IP =>  $_SERVER[PaymentContract::REMOTE_ADDR],
            PaymentContract::PG_USER_ID =>  $userId,
            PaymentContract::PG_CARD_ID =>  $cardId,
            //PaymentContract::PG_USER_ID =>  self::ID,
            //PaymentContract::PG_PARAM1  =>  '',
            //PaymentContract::PG_PARAM2  =>  '',
            //PaymentContract::PG_PARAM3  =>  '',

            PaymentContract::PG_ORDER_ID    =>  $id,
            PaymentContract::PG_MERCHANT_ID =>  self::ID,
            PaymentContract::PG_DESCRIPTION =>  'Бронирование в '.$description,
            //PaymentContract::PG_CURRENCY    =>  self::CURRENCY,
            //PaymentContract::PG_CHECK_URL   =>  self::CHECK_URL,
            PaymentContract::PG_RESULT_URL  =>  self::RESULT_URL,
            PaymentContract::PG_SUCCESS_URL =>  self::SUCCESS_URL,
            PaymentContract::PG_FAILURE_URL =>  self::FAILURE_URL,
            //PaymentContract::PG_STATE_URL   =>  self::STATE_URL,
            //PaymentContract::PG_SITE_URL    =>  self::RETURN_URL.'/'.$id,
            //PaymentContract::PG_LIFETIME    =>  self::LIFETIME,
            PaymentContract::PG_USER_PHONE  =>  self::PHONE,
            PaymentContract::PG_LANGUAGE    =>  self::LANGUAGE,

            //PaymentContract::PG_RECURRING_START =>  1,
            PaymentContract::PG_TESTING_MODE    =>  1,
            //PaymentContract::PG_PAYMENT_ROUTE   =>  self::PAYMENT_ROUTE,
            //PaymentContract::PG_REQUEST_METHOD  =>  PaymentContract::POST,
            //PaymentContract::PG_PAYMENT_SYSTEM  =>  self::PAYMENT_SYSTEM,

            PaymentContract::PG_SUCCESS_URL_METHODS =>  PaymentContract::GET,
            PaymentContract::PG_FAILURE_URL_METHODS =>  PaymentContract::GET,
            //PaymentContract::PG_STATE_URL_METHOD    =>  PaymentContract::GET,
            PaymentContract::PG_USER_CONTACT_EMAIL  =>  self::EMAIL,
            //PaymentContract::PG_POSTPONE_PAYMENT    =>  0,

            //PaymentContract::PG_RECURRING_LIFETIME  =>  self::RECURRING_LIFETIME,
//            PaymentContract::PG_RECEIPT_POSITIONS   =>  [
//                [
//                    PaymentContract::COUNT  =>  1,
//                    PaymentContract::NAME   =>  'название товара',
//                    PaymentContract::TAX_TYPE   =>  3,
//                    PaymentContract::PRICE  =>  0,
//                ]
//            ],
        ]);
    }

    public function signature($request) {
        //$request = $this->makeFlatParamsArray($request);
        ksort($request);
        array_unshift($request, self::INIT);
        array_push($request, self::KEY);
        $request[PaymentContract::PG_SIG] = md5(implode(';', $request));
        unset($request[0], $request[1]);
        return $request;
    }

    public function makeFlatParamsArray($arrParams, $parent_name = '') {
        $arr    =   [];
        $i      =   0;
        foreach ($arrParams as $key => $val) {
            $name   =   $parent_name.$key.sprintf('%03d', ++$i);
            if (is_array($val)) {
                $arr    =   array_merge($arr, $this->makeFlatParamsArray($val, $name));
                continue;
            }
            $arr    +=  array($name =>  (string)$val);
        }
        return $arr;
    }


    public function result($data):void {
        if (array_key_exists(PaymentContract::PG_RESULT,$data)) {
            if ((int) $data[PaymentContract::PG_RESULT] === 1) {
                $this->paymentRepository->success($data[PaymentContract::PG_ORDER_ID]);
            } else {
                $this->paymentRepository->failure($data[PaymentContract::PG_ORDER_ID]);
            }
        }
    }

    public function post($data) {

    }

    public function check($data) {

    }

    public function success($data) {
        return 'success';
    }

    public function failure($data) {
        return 'failure';
    }
}
