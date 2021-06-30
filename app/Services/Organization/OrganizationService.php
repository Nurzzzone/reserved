<?php


namespace App\Services\Organization;

use App\Services\BaseService;
use App\Domain\Repositories\Organization\OrganizationRepositoryInterface;
use App\Domain\Repositories\Review\ReviewRepositoryInterface;

class OrganizationService extends BaseService
{
    protected $organizationRepository;
    protected $reviewRepository;

    public function __construct(OrganizationRepositoryInterface $organizationRepository, ReviewRepositoryInterface $reviewRepository)
    {
        $this->organizationRepository   =   $organizationRepository;
        $this->reviewRepository         =   $reviewRepository;
    }

    public function updateRating($id):void
    {
        $average    =   $this->reviewRepository->sumRating($id);
        $this->organizationRepository->updateRating($id,$average);
    }

    public function getByIds($ids)
    {
        return $this->organizationRepository->getByIds($ids);
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

    public function getByCategoryId(int $id, int $paginate)
    {
        return $this->organizationRepository->getByCategoryId($id,$paginate);
    }

    public function getByUserId(int $id) {
        return $this->organizationRepository->getByUserId($id);
    }
}
