<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService  =   $menuService;
    }

    public function getByOrganizationId($organizationId)
    {
        return  $this->menuService->getByOrganizationId($organizationId);
    }
}
