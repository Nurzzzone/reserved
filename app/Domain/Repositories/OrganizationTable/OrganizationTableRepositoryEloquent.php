<?php


namespace App\Domain\Repositories\OrganizationTable;

use App\Domain\Contracts\OrganizationTablesContract;
use App\Models\OrganizationTables;

class OrganizationTableRepositoryEloquent implements OrganizationTableRepositoryInterface
{
    public function create(int $organizationId, string $key, string $name, int $limit = 0)
    {
        return OrganizationTables::create([
            OrganizationTablesContract::ORGANIZATION_ID =>  $organizationId,
            OrganizationTablesContract::KEY             =>  $key,
            OrganizationTablesContract::NAME            =>  $name,
            OrganizationTablesContract::LIMIT           =>  $limit
        ]);
    }

    public function getByOrganizationId($id) {
        return OrganizationTables::where([
            [OrganizationTablesContract::ORGANIZATION_ID,$id],
            [OrganizationTablesContract::STATUS,OrganizationTablesContract::ENABLED]
        ])->get();
    }

    public function getById($id)
    {
        return OrganizationTables::where([
            [OrganizationTablesContract::ID,$id],
            [OrganizationTablesContract::STATUS,OrganizationTablesContract::ENABLED]
        ])->first();
    }
}
