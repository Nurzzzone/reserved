<?php


namespace App\Domain\Contracts;


class OrganizationImageContract extends MainContract
{
    const TABLE =   'organization_images';

    const FILLABLE  =   [
        self::ORGANIZATION_ID,
        self::IMAGE,
        self::STATUS,
        self::PARENT_ID,
        self::LFT,
        self::RGT,
        self::DEPTH
    ];
}
