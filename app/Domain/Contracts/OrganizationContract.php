<?php


namespace App\Domain\Contracts;


class OrganizationContract extends MainContract
{
    const TABLE =   'organizations';

    const FILLABLE  =   [
        self::USER_ID,
        self::CATEGORY_ID,
        self::TITLE,
        self::TITLE_KZ,
        self::TITLE_EN,
        self::RATING,
        self::IMAGE,
        self::DESCRIPTION,
        self::DESCRIPTION_KZ,
        self::DESCRIPTION_EN,
        self::ADDRESS,
        self::ADDRESS_KZ,
        self::ADDRESS_EN,
        self::PRICE,
        self::TABLES,

        self::START_MONDAY,
        self::END_MONDAY,

        self::START_TUESDAY,
        self::END_TUESDAY,

        self::START_WEDNESDAY,
        self::END_WEDNESDAY,

        self::START_THURSDAY,
        self::END_THURSDAY,

        self::START_FRIDAY,
        self::END_FRIDAY,

        self::START_SATURDAY,
        self::END_SATURDAY,

        self::START_SUNDAY,
        self::END_SUNDAY,

        self::STATUS
    ];
}
