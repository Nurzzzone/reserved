<?php


namespace App\Domain\Repositories\OrganizationCity;

use App\Domain\Contracts\OrganizationContract;
use App\Models\OrganizationCity;
use App\Domain\Contracts\OrganizationCityContract;
use Illuminate\Support\Facades\DB;

class OrganizationCityRepositoryEloquent implements OrganizationCityRepositoryInterface
{
    private $take   =   15;
    public function getByCityId($id, $paginate, $search)
    {
        $ids    =   OrganizationCity::select(OrganizationContract::TABLE.'.id')
            ->join(OrganizationContract::TABLE,OrganizationContract::TABLE.'.'.OrganizationContract::ID,'=',OrganizationCityContract::TABLE.'.'.OrganizationCityContract::ORGANIZATION_ID)
            ->where([
                [OrganizationCityContract::TABLE.'.'.OrganizationCityContract::CITY_ID,$id],
                [OrganizationCityContract::TABLE.'.'.OrganizationCityContract::STATUS,OrganizationCityContract::ENABLED]
            ])
            ->where(OrganizationContract::TABLE.'.'.OrganizationContract::TITLE,'like','%'.$search.'%')
            ->orWhere(OrganizationContract::TABLE.'.'.OrganizationContract::TITLE_KZ,'like','%'.$search.'%')
            ->orWhere(OrganizationContract::TABLE.'.'.OrganizationContract::TITLE_EN,'like','%'.$search.'%')
            ->orderBy(OrganizationCityContract::TABLE.'.'.OrganizationCityContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
        $list   =   [];
        foreach ($ids as &$id) {
            $list[] =   $id->id;
        }
        return $list;
    }
}
