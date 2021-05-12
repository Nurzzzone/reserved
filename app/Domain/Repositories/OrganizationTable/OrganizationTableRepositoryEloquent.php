<?php


namespace App\Domain\Repositories\OrganizationTable;

use App\Domain\Contracts\OrganizationTablesContract;
use App\Models\OrganizationTables;

class OrganizationTableRepositoryEloquent implements OrganizationTableRepositoryInterface
{
    public function create(int $organizationId, string $id, string $name)
    {
        return OrganizationTables::create([
            OrganizationTablesContract::ORGANIZATION_ID =>  $organizationId,
            OrganizationTablesContract::KEY             =>  $id,
            OrganizationTablesContract::NAME            =>  $name,
            OrganizationTablesContract::LIMIT           =>  0
        ]);
    }
}
