<?php

namespace App\Services\WebTraffic;

use App\Domain\Repositories\WebTraffic\WebTrafficRepositoryInterface;
use Illuminate\Support\Collection;

class WebTrafficService
{
    protected $webTrafficRepository;
    public function __construct(WebTrafficRepositoryInterface $webTrafficRepository)
    {
        $this->webTrafficRepository =   $webTrafficRepository;
    }

    public function create($data)
    {
        return $this->webTrafficRepository->create($data);
    }

    public function getByOrganizationIdAndDate($organizationId, $date): Collection
    {
        return $this->webTrafficRepository->getByOrganizationIdAndDate($organizationId,$date);
    }

    public function getByOrganizationId($organizationId): Collection
    {
        return $this->webTrafficRepository->getByOrganizationId($organizationId);
    }

    public function getByDateAndOrganizationIdAndIp($date,$organizationId,$ip): Collection
    {
        return $this->webTrafficRepository->getByDateAndOrganizationIdAndIp($date,$organizationId,$ip);
    }
}
