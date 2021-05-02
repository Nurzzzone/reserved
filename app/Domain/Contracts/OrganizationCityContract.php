<?php


namespace App\Domain\Contracts;


class OrganizationCityContract extends MainContract
{
    const TABLE =   'organization_cities';

    const FILLABLE  =   [
        self::ORGANIZATION_ID,
        self::CITY_ID,
        self::STATUS
    ];
}
