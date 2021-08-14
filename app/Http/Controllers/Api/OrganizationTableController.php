<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrganizationTable\OrganizationTableService;
use App\Http\Resources\OrganizationTablesCollection;

class OrganizationTableController extends Controller
{
    protected $organizationTableService;
    public function __construct(OrganizationTableService $organizationTableService)
    {
        $this->organizationTableService =   $organizationTableService;
    }

    public function getByOrganizationId($organizationId)
    {
        return new OrganizationTablesCollection($this->organizationTableService->getByOrganizationId($organizationId));
    }

    public function create()
    {
        
    }

}
