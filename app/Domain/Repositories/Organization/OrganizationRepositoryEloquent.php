<?php


namespace App\Domain\Repositories\Organization;

use App\Domain\Contracts\OrganizationContract;
use App\Models\Organization;

class OrganizationRepositoryEloquent implements OrganizationRepositoryInterface
{

    private $take   =   15;

    public function getByIds($ids)
    {
        return Organization::with('user','category','images','menus')->where(OrganizationContract::STATUS,OrganizationContract::ENABLED)->whereIn(OrganizationContract::ID,$ids)->get();
    }

    public function getIdsByUserId(int $userId)
    {
        return Organization::where(OrganizationContract::USER_ID,$userId)->get()->toArray();
    }

    public function list(int $paginate)
    {
        return Organization::with('user','category','images','menus')->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function searchByTitle(string $search, int $paginate)
    {
        return Organization::with('user','category','images','menus')
        ->where(OrganizationContract::TITLE, 'like', '%'.$search.'%')
        ->orWhere(OrganizationContract::TITLE_KZ, 'like', '%'.$search.'%')
        ->orWhere(OrganizationContract::TITLE_EN, 'like', '%'.$search.'%')->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function getById($id)
    {
        return Organization::with('user','category','images','menus')->where(OrganizationContract::ID,$id)->first();
    }

    public function getByCategoryId($id, $paginate)
    {
        return Organization::with('user','category','images','menus')->where(OrganizationContract::CATEGORY_ID,$id)->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function updateRating($id,$rating)
    {
        return Organization::where(OrganizationContract::ID,$id)->update([
            OrganizationContract::RATING    =>  $rating
        ]);
    }

    public function getByUserId(int $id)
    {
        return Organization::where([
            OrganizationContract::USER_ID   =>  $id,
            OrganizationContract::STATUS    =>  OrganizationContract::ENABLED
        ])->get();
    }

    public function getByCategoryIdAndCityId($id, $cityId, $paginate)
    {
        return Organization::with('user','category','images','menus')
        ->where([
            [OrganizationContract::CATEGORY_ID,$id],
            [OrganizationContract::CITY_ID,$cityId],
            [OrganizationContract::STATUS,OrganizationContract::ENABLED]
        ])->get();
    }
}
