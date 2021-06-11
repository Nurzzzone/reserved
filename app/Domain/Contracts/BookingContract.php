<?php


namespace App\Domain\Contracts;


class BookingContract extends MainContract {
    const TABLE =   'bookings';

    const FILLABLE  =   [
        self::IIKO_BOOKING_ID,
        self::USER_ID,
        self::ORGANIZATION_ID,
        self::ORGANIZATION_TABLE_LIST_ID,
        self::TIME,
        self::DATE,
        self::COMMENT,
        self::STATUS
    ];
}
