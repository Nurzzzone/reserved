<?php

namespace App\Domain\Repositories\WebTraffic;

use App\Domain\Contracts\MainContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Domain\Contracts\WebTrafficContract;
use App\Models\webTraffic;

class WebTrafficRepositoryEloquent implements WebTrafficRepositoryInterface
{
    public function create($data)
    {
        return webTraffic::create($data);
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

    public function getByDateAndOrganizationIdAndIpAndWeb($date,$organizationId,$ip,$website)
    {
        return DB::table(WebTrafficContract::TABLE)
            ->where([
                [MainContract::ORGANIZATION_ID,$organizationId],
                [MainContract::WEBSITE,$website],
                [MainContract::IP,$ip],
                [MainContract::STATUS,MainContract::ON]
            ])
            ->whereDate(MainContract::CREATED_AT,'=',$date)
            ->first();
    }

}
