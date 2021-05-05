<?php


namespace App\Services\Organization;

use App\Services\BaseService;
use App\Domain\Repositories\Organization\OrganizationRepositoryInterface;

class OrganizationService extends BaseService
{
    protected $organizationRepository;

    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository   =   $organizationRepository;
    }

    public function list(int $paginate)
    {
        return $this->organizationRepository->list($paginate);
    }

    public function search(string $search, int $paginate)
    {
        return $this->organizationRepository->searchByTitle($search,$paginate);
    }

    public function getById(int $id)
    {
        return $this->organizationRepository->getById($id);
    }
}
