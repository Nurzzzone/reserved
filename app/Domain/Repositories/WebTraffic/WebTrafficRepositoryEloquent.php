<?php

namespace App\Domain\Repositories\WebTraffic;

use App\Domain\Contracts\MainContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Contracts\WebTrafficContract;

class WebTrafficRepositoryEloquent implements WebTrafficRepositoryInterface
{
    public function create($data)
    {
        return DB::table(WebTrafficContract::TABLE)->create($data);
    }

    public function getByOrganizationIdAndDate($organizationId, $date): Collection
    {
        return DB::table(WebTrafficContract::TABLE)
            ->where([
                [MainContract::ORGANIZATION_ID,$organizationId],
                [MainContract::STATUS,MainContract::ON]
            ])
            ->whereDate(MainContract::CREATED_AT,'=',$date)
            ->get();
    }

    public function getByOrganizationId($organizationId): Collection
    {
        return DB::table(WebTrafficContract::TABLE)
            ->where([
                [MainContract::ORGANIZATION_ID,$organizationId],
                [MainContract::STATUS,MainContract::ON]
            ])
            ->get();
    }

    public function getByDateAndOrganizationIdAndIp($date,$organizationId,$ip): Collection
    {
        return DB::table(WebTrafficContract::TABLE)
            ->where([
                [MainContract::ORGANIZATION_ID,$organizationId],
                [MainContract::IP,$ip],
                [MainContract::STATUS,MainContract::ON]
            ])
            ->whereDate(MainContract::CREATED_AT,'=',$date)
            ->get();
    }

}
