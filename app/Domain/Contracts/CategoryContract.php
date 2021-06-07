<?php


namespace App\Domain\Contracts;


class CategoryContract extends MainContract
{
    const TABLE =   'categories';

    const FILLABLE  =   [
        self::TITLE,
        self::TITLE_KZ,
        self::TITLE_EN,
    ];
}
