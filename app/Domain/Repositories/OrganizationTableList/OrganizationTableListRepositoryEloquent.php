<?php


namespace App\Domain\Repositories\OrganizationTableList;

use App\Domain\Contracts\OrganizationTableListContract;
use App\Models\OrganizationTableList;

class OrganizationTableListRepositoryEloquent implements OrganizationTableListRepositoryInterface
{
    public function create(int $organizationId, int $sectionId, string $key, string $title, int $limit = 0) {
        return OrganizationTableList::create([
            OrganizationTableListContract::ORGANIZATION_ID  =>  $organizationId,
            OrganizationTableListContract::ORGANIZATION_TABLE_ID    =>  $sectionId,
            OrganizationTableListContract::KEY  =>  $key,
            OrganizationTableListContract::TITLE    =>  $title,
            OrganizationTableListContract::LIMIT    =>  $limit,
        ]);
    }
}
