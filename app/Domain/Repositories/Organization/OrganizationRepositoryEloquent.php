<?php


namespace App\Domain\Repositories\Organization;

use App\Domain\Contracts\OrganizationContract;
use App\Models\Organization;

class OrganizationRepositoryEloquent implements OrganizationRepositoryInterface
{

    private $take   =   15;

    public function getIdsByUserId(int $userId)
    {
        return Organization::where(OrganizationContract::USER_ID,$userId)->get()->toArray();
    }

    public function list(int $paginate)
    {
        return Organization::with('user','category','images')->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function searchByTitle(string $search, int $paginate)
    {
        return Organization::with('user','category','images')
        ->where(OrganizationContract::TITLE, 'like', '%'.$search.'%')
        ->orWhere(OrganizationContract::TITLE_KZ, 'like', '%'.$search.'%')
        ->orWhere(OrganizationContract::TITLE_EN, 'like', '%'.$search.'%')->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function getById($id)
    {
        return Organization::with('user','category','images')->where(OrganizationContract::ID,$id)->first();
    }

    public function getByIds($ids)
    {
        return Organization::with('user','category','images')->whereIn(OrganizationContract::ID,$ids)->get();
    }
}
