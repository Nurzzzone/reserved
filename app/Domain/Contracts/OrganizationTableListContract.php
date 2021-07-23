<?php


namespace App\Domain\Contracts;


class OrganizationTableListContract extends MainContract
{
    const TABLE =   'organization_table_lists';

    const FILLABLE  =   [
        self::ORGANIZATION_ID,
        self::ORGANIZATION_TABLE_ID,
        self::TITLE,
        self::LIMIT,
        self::STATUS
    ];
}

