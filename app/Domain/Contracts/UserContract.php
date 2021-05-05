<?php


namespace App\Domain\Contracts;


class UserContract extends MainContract
{
    const TABLE =   'users';

    const FILLABLE  =   [
        self::USER_ID,
        self::ROLE,
        self::BLOCKED,
        self::NAME,
        self::AVATAR,
        self::PHONE,
        self::CODE,
        self::PHONE_VERIFIED_AT,
        self::EMAIL,
        self::EMAIL_VERIFIED_AT,
        self::PASSWORD,
        self::API_TOKEN
    ];

    const HIDDEN    =   [
        self::PASSWORD,
        self::REMEMBER_TOKEN
    ];

    const CASTS     =   [
        self::EMAIL_VERIFIED_AT =>  'datetime'
    ];
}
