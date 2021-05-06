<?php


namespace App\Services\OrganizationCity;

use App\Services\BaseService;
use App\Domain\Repositories\OrganizationCity\OrganizationCityRepositoryInterface;

class OrganizationCityService extends BaseService
{
    protected $organizationCityRepository;
    public function __construct(OrganizationCityRepositoryInterface $organizationCityRepository)
    {
        $this->organizationCityRepository   =   $organizationCityRepository;
    }

    public function getByCityId($id, $paginate, $search)
    {
        return $this->organizationCityRepository->getByCityId($id, $paginate, $search);
    }
}
