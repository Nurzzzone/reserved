<?php


namespace App\Services\OrganizationTableList;

use App\Services\BaseService;
use App\Domain\Repositories\OrganizationTableList\OrganizationTableListRepositoryInterface;

class OrganizationTableListService extends BaseService
{
    protected $organizationTableListRepository;
    public function __construct(OrganizationTableListRepositoryInterface $organizationTableListRepository)
    {
        $this->organizationTableListRepository  =   $organizationTableListRepository;
    }

    public function getByTableId($id) {
        return $this->organizationTableListRepository->getByTableId($id);
    }

    public function getById($id) {
        return $this->organizationTableListRepository->getById($id);
    }

    public function getByOrganizationId($id) {
        return $this->organizationTableListRepository->getByOrganizationId($id);
    }
}
