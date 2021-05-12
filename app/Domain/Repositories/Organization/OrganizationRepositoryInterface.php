<?php


namespace App\Domain\Repositories\Organization;


interface OrganizationRepositoryInterface
{
    public function getIdsByUserId(int $userId);
    public function list(int $paginate);
    public function getById(int $id);
}
