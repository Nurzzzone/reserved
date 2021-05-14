<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\OrganizationTablesContract;
use App\Http\Resources\OrganizationTablesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\OrganizationService;
use App\Models\OrganizationTables;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\OrganizationTablesCollection;

class OrganizationController extends Controller
{

    protected $paginate =   1;
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService  =   $organizationService;
    }

    public function list(Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new OrganizationCollection($this->organizationService->list($this->paginate));
    }

    public function search($search, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new OrganizationCollection($this->organizationService->search($search,$this->paginate));
    }

    public function getSectionsById($id)
    {
        return new OrganizationTablesCollection(OrganizationTables::with('organizationTables')->where(OrganizationTablesContract::ORGANIZATION_ID,$id)->get());
    }

    public function getByCategoryId($id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new OrganizationCollection($this->organizationService->getByCategoryId($id,$this->paginate));
    }

    public function getById($id)
    {
        $organization   =   $this->organizationService->getById($id);
        if ($organization) {
            return new OrganizationResource($organization);
        }
        return response(['message'  =>  'Организация не найдено'],404);
    }
}
