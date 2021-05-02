<?php


namespace App\Domain\Repositories\Organization;

use App\Domain\Contracts\OrganizationContract;
use App\Models\Organization;

class OrganizationRepositoryEloquent implements OrganizationRepositoryInterface
{
    public function getIdsByUserId(int $userId)
    {
        return Organization::where(OrganizationContract::USER_ID,$userId)->get()->toArray();
    }
}
