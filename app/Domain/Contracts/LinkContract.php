<?php


namespace App\Domain\Contracts;


class LinkContract extends MainContract
{
    const TABLE =   'urls';

    const FILLABLE  =   [
        self::KEY,
        self::URL,
        self::EXPIRATION,
        self::STATUS
    ];
}
