<?php


namespace App\Services\OrganizationTable;

use App\Services\BaseService;
use App\Domain\Repositories\OrganizationTable\OrganizationTableRepositoryInterface;

class OrganizationTableService extends BaseService
{
    protected $organizationTableRepository;
    public function __construct(OrganizationTableRepositoryInterface $organizationTableRepository)
    {
        $this->organizationTableRepository  =   $organizationTableRepository;
    }

    public function getByOrganizationId($id) {
        return $this->organizationTableRepository->getByOrganizationId($id);
    }
}
