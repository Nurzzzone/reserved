<?php

namespace App\Services\Menu;

use App\Services\BaseService;

use App\Domain\Repositories\Menu\MenuRepositoryInterface;

class MenuService extends BaseService
{
    protected $menuRepository;
    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository   =   $menuRepository;
    }

    public function getByOrganizationId($organizationId)
    {
        return $this->menuRepository->getByOrganizationId($organizationId);
    }
}
