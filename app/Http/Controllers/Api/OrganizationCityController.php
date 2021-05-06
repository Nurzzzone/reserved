<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrganizationCity\OrganizationCityService;
use App\Services\Organization\OrganizationService;
use App\Http\Resources\OrganizationCollection;

class OrganizationCityController extends Controller
{
    protected $organizationCityService;
    protected $organizationService;
    protected $paginate =   1;
    protected $search   =   '';

    public function __construct(OrganizationCityService $organizationCityService, OrganizationService $organizationService)
    {
        $this->organizationCityService  =   $organizationCityService;
        $this->organizationService      =   $organizationService;
    }

    public function getByCityId($id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        if ($request->has('search')) {
            $this->search   =   $request->input('search');
        }
        $ids    =   $this->organizationCityService->getByCityId($id,$this->paginate,$this->search);
        return new OrganizationCollection($this->organizationService->getByIds($ids));
    }
}
