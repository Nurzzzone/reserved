<?php

namespace App\Domain\Repositories\Menu;

use App\Models\Menu;
use App\Domain\Contracts\MenuContract;

class MenuRepositoryEloquent implements MenuRepositoryInterface
{
    public function getByOrganizationId($organizationId)
    {
        return Menu::where([
            [MenuContract::ORGANIZATION_ID,$organizationId],
            [MenuContract::STATUS,MenuContract::ON]
        ])->get();
    }
}
