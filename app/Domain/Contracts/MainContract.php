<?php


namespace App\Domain\Contracts;


use Carbon\Carbon;

class MainContract
{
    const ID        =   'id';
    const KEY       =   'key';
    const PARENT_ID =   'parent_id';
    const ORDER     =   'order';
    const NAME      =   'name';
    const SLUG      =   'slug';
    const RATING    =   'rating';
    const IMAGE     =   'image';
    const ADDRESS   =   'address';
    const CASCADE   =   'cascade';
    const SET_NULL  =   'set null';
    const DATE      =   'date';
    const PHONE     =   'phone';
    const CONTENT   =   'content';
    const SCORE     =   'score';
    const EMAIL     =   'email';
    const PASSWORD  =   'password';
    const AVATAR    =   'avatar';
    const TITLE     =   'title';
    const TITLE_KZ  =   'title_kz';
    const TITLE_EN  =   'title_en';
    const TABLES    =   'tables';
    const PRICE     =   'price';
    const STATUS    =   'status';
    const CODE      =   'code';
    const BLOCKED   =   'blocked';
    const COMMENT   =   'comment';
    const API_ID    =   'api_id';
    const IIKO_ID   =   'iiko_id';
    const LIMIT     =   'limit';
    const LFT       =   'lft';
    const RGT       =   'rgt';
    const DEPTH     =   'depth';
    const MONDAY    =   'monday';
    const TUESDAY   =   'tuesday';
    const WEDNESDAY =   'wednesday';
    const THURSDAY  =   'thursday';
    const FRIDAY    =   'friday';
    const SATURDAY  =   'saturday';
    const SUNDAY    =   'sunday';
    const START     =   'start';
    const END       =   'end';
    const IMAGES    =   'images';
    const WEBSITE   =   'website';
    const VALUE     =   'value';
    const URL       =   'url';
    const PG_AMOUNT =   'pg_amount';
    const PG_SALT   =   'pg_salt';
    const POST      =   'POST';
    const GET       =   'GET';
    const PG_PARAM1 =   'pg_param1';
    const PG_PARAM2 =   'pg_param2';
    const PG_PARAM3 =   'pg_param3';
    const COUNT     =   'count';
    const TAX_TYPE  =   'tax_type';
    const PG_SIG    =   'pg_sig';
    const PAGINATE  =   'paginate';
    const CARD_ID   =   'card_id';
    const PG_RESULT =   'pg_result';
    const PAYED     =   'payed';
    const API_KEY   =   'api_key';
    const TIMEZONE  =   'timezone';
    const UTC       =   'UTC';
    const JSON      =   'json';
    const TIME      =   'time';

    const ON        =   'on';
    const OFF       =   'off';

    const STATE     =   [
        self::ON,
        self::OFF
    ];

    const ENABLED   =   'ENABLED';
    const CHECKING  =   'CHECKING';
    const DISABLED  =   'DISABLED';
    const CANCELED  =   'CANCELED';
    const DELETED   =   'DELETED';

    const STATUSES  =   [
        self::ENABLED,
        self::DISABLED
    ];

    const PAYMENT_STATUSES  =   [
        self::ENABLED,
        self::PAYED,
        self::DISABLED
    ];

    const STATUSES_BOOKING  =   [
        self::CHECKING,
        self::ENABLED,
        self::DISABLED,
        self::CANCELED,
        self::DELETED
    ];

    const STATUSES_REVIEWS  =   [
        self::ENABLED,
        self::DISABLED,
        self::CHECKING,
        self::CANCELED,
        self::DELETED
    ];

    const PG_PAYMENT_ID =   'pg_payment_id';
    const PG_CARD_ID    =   'pg_card_id';
    const PG_BACK_LINK  =   'pg_back_link';
    const PG_POST_LINK  =   'pg_post_link';
    const PG_USER_ID    =   'pg_user_id';
    const PG_USER_PHONE =   'pg_user_phone';
    const PG_LIFETIME   =   'pg_lifetime';
    const PG_ORDER_ID   =   'pg_order_id';
    const EXPIRATION    =   'expiration';
    const BOOKING_ID    =   'booking_id';
    const API_TOKEN     =   'api_token';
    const SETTINGS      =   'settings';
    const DESCRIPTION   =   'description';
    const PG_SITE_URL   =   'pg_site_url';
    const MINIMAL_PRICE =   'minimal_price';
    const IS_AVAILABLE  =   'is_available';
    const ADDRESS_KZ    =   'address_kz';
    const ADDRESS_EN    =   'address_en';
    const API_SECRET    =   'api_secret';
    const ORGANIZATION  =   'organization';
    const PG_CURRENCY   =   'pg_currency';
    const PG_CHECK_URL  =   'pg_check_url';
    const PG_RESULT_URL =   'pg_result_url';
    const PG_STATE_URL  =   'pg_state_url';
    const PG_USER_IP    =   'pg_user_ip';
    const REMOTE_ADDR   =   'REMOTE_ADDR';
    const PG_LANGUAGE   =   'PG_LANGUAGE';

    const PG_REDIRECT_URL   =   'pg_redirect_url';
    const PG_TESTING_MODE   =   'pg_testing_mode';
    const PG_PAYMENT_SYSTEM =   'pg_payment_system';
    const DESCRIPTION_KZ    =   'description_kz';
    const DESCRIPTION_EN    =   'description_en';
    const PG_FAILURE_URL    =   'pg_failure_url';
    const PG_SUCCESS_URL    =   'pg_success_url';
    const PG_REQUEST_METHOD =   'pg_request_method';
    const PG_PAYMENT_ROUTE  =   'pg_payment_route';
    const PG_DESCRIPTION    =   'pg_description';
    const PG_MERCHANT_ID    =   'pg_merchant_id';
    const PHONE_VERIFIED_AT =   'phone_verified_at';
    const REMEMBER_TOKEN    =   'remember_token';
    const EMAIL_VERIFIED_AT =   'email_verified_at';
    const USER_ID           =   'user_id';
    const CITY_ID           =   'city_id';
    const ORGANIZATION_ID   =   'organization_id';
    const POSITION_ID       =   'position_id';
    const ROLE_ID           =   'role_id';
    const COUNTRY_ID        =   'country_id';
    const CATEGORY_ID       =   'category_id';

    const START_MONDAY      =   'start_monday';
    const START_TUESDAY     =   'start_tuesday';
    const START_WEDNESDAY   =   'start_wednesday';
    const START_THURSDAY    =   'start_thursday';
    const START_FRIDAY      =   'start_friday';
    const START_SATURDAY    =   'start_saturday';
    const START_SUNDAY      =   'start_sunday';

    const END_MONDAY        =   'end_monday';
    const END_TUESDAY       =   'end_tuesday';
    const END_WEDNESDAY     =   'end_wednesday';
    const END_THURSDAY      =   'end_thursday';
    const END_FRIDAY        =   'end_friday';
    const END_SATURDAY      =   'end_saturday';
    const END_SUNDAY        =   'end_sunday';

    const CREATED_AT        =   'created_at';
    const UPDATED_AT        =   'updated_at';
    const ROLE              =   'role';
    const ADMINISTRATOR     =   'administrator';
    const MODERATOR         =   'moderator';
    const USER              =   'user';

    const ROLES             =   [
        self::ADMINISTRATOR,
        self::MODERATOR,
        self::USER
    ];

    const TRANSLATE =   [
        self::USER          =>  'Пользователь',
        self::ADMINISTRATOR =>  'Администратор',
        self::MODERATOR     =>  'Модератор',
        self::ENABLED       =>  'Включен',
        self::CHECKING      =>  'На проверке',
        self::DISABLED      =>  'Отключен',
        self::DELETED       =>  'Удален',
        self::CANCELED      =>  'Отменен',
        self::ON            =>  'Активный',
        self::OFF           =>  'Неактивный',
        'NOT_VERIFIED'      =>  'Не подтвержден',
        'VERIFIED'          =>  'Подтвержден',
        'NOT_SPECIFIED'     =>  '',
        'ALL_DAY'           =>  'Круглостуочно'
    ];

    const PG_RECURRING_START    =   'pg_recurring_start';
    const PG_USER_CONTACT_EMAIL =   'pg_user_contact_email';
    const PG_STATE_URL_METHOD   =   'pg_state_url_method';
    const ORGANIZATION_TABLE_ID =   'organization_table_id';
    const ORGANIZATION_TABLES   =   'organization_tables';
    const IIKO_ORGANIZATION_ID  =   'iiko_organization_id';
    const PG_POSTPONE_PAYMENT   =   'pg_postpone_payment';
    const PG_RECURRING_LIFETIME =   'pg_recurring_lifetime';
    const PG_RECEIPT_POSITIONS  =   'pg_receipt_positions';

    const PG_SUCCESS_URL_METHOD     =   'pg_success_url_method';
    const PG_FAILURE_URL_METHOD     =   'pg_failure_url_method';

    const ORGANIZATION_TABLE_LIST_ID    =   'organization_table_list_id';

    public static function getCheck($value)
    {
        $value  =   strtolower($value);
        if (array_key_exists($value,self::TRANSLATE)) {
            return self::TRANSLATE[$value];
        }
        return $value;
    }

    public static function verifiedCheck($value)
    {
        if ($value) {
            return UserContract::TRANSLATE['VERIFIED'].' ('.Carbon::createFromTimeStamp(strtotime($value))->diffForHumans().')';
        }
        return UserContract::TRANSLATE['NOT_VERIFIED'];
    }

    public static function dateCheck($value)
    {
        if ($value) {
            return date('d/m/Y', strtotime($value));
        }
        return self::TRANSLATE['NOT_SPECIFIED'];
    }
}
