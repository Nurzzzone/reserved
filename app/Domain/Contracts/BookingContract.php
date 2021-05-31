<?php


namespace App\Domain\Contracts;


class BookingContract extends MainContract {
    const TABLE =   'bookings';

    const FILLABLE  =   [
        self::USER_ID,
        self::ORGANIZATION_ID,
        self::ORGANIZATION_TABLE_LIST_ID,
        self::START,
        self::END,
        self::DATE,
        self::COMMENT,
        self::STATUS
    ];
}
