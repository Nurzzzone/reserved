<?php


namespace App\Domain\Repositories\OrganizationTableList;

use App\Domain\Contracts\OrganizationTableListContract;
use App\Models\OrganizationTableList;

class OrganizationTableListRepositoryEloquent implements OrganizationTableListRepositoryInterface
{
    public function create(int $organizationId, int $sectionId, string $key, string $title, int $limit = 0)
    {
        return OrganizationTableList::create([
            OrganizationTableListContract::ORGANIZATION_ID  =>  $organizationId,
            OrganizationTableListContract::ORGANIZATION_TABLE_ID   =>  $sectionId,
            OrganizationTableListContract::KEY  =>  $key,
            OrganizationTableListContract::TITLE    =>  $title,
            OrganizationTableListContract::LIMIT    =>  $limit,
        ]);
    }

    public function update($id, $input)
    {
        OrganizationTableList::where(OrganizationTableListContract::ID,$id)->update($input);
        return OrganizationTableList::where([
            [OrganizationTableListContract::ID,$id],
            [OrganizationTableListContract::STATUS,'!=',OrganizationTableListContract::DISABLED]
        ])->first();
    }

    public function getByTableId($id)
    {
        return OrganizationTableList::with('organization')->where([
            [OrganizationTableListContract::ORGANIZATION_TABLE_ID,$id],
            [OrganizationTableListContract::STATUS,'!=',OrganizationTableListContract::DISABLED]
        ])->get();
    }

    public function getById($id)
    {
        return OrganizationTableList::with('organization','organizationTable')->where([
            [OrganizationTableListContract::ID,$id],
            [OrganizationTableListContract::STATUS,'!=',OrganizationTableListContract::DISABLED]
        ])->first();
    }

    public function getByOrganizationId($id)
    {
        return OrganizationTableList::with('organizationTable')->where([
            [OrganizationTableListContract::ORGANIZATION_ID,$id],
            [OrganizationTableListContract::STATUS,'!=',OrganizationTableListContract::DISABLED]
        ])->get();
    }
}
