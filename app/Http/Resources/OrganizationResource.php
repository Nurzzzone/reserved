<?php

namespace App\Http\Resources;

use App\Domain\Contracts\MainContract;
use App\Domain\Contracts\OrganizationContract;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Menu\MenuCollection;

class OrganizationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            OrganizationContract::ID        =>  $this->{OrganizationContract::ID},
            OrganizationContract::CITY_ID   =>  $this->{OrganizationContract::CITY_ID},
            OrganizationContract::RATING    =>  $this->{OrganizationContract::RATING},
            OrganizationContract::IMAGE     =>  $this->{OrganizationContract::IMAGE}?$this->{OrganizationContract::IMAGE}:($this->{OrganizationContract::CATEGORY_ID}===1?'/img/logo/restaurant.svg':($this->{OrganizationContract::CATEGORY_ID}===2?'/img/logo/cafe.svg':'/img/logo/bar.svg')),
            OrganizationContract::WALLPAPER =>  $this->{OrganizationContract::WALLPAPER}?$this->{OrganizationContract::WALLPAPER}:'/img/logo/wall.png',
            OrganizationContract::TITLE     =>  $this->{OrganizationContract::TITLE},
            OrganizationContract::TIME      =>  '-',
            MainContract::PHONE =>  $this->{MainContract::PHONE},
            MainContract::EMAIL =>  $this->{MainContract::EMAIL},
            MainContract::WEBSITE   =>  $this->{MainContract::WEBSITE},
            MainContract::CATEGORY  =>  $this->{MainContract::CATEGORY_ID},
            OrganizationContract::DESCRIPTION   =>  $this->description,
            OrganizationContract::DESCRIPTION_KZ    =>  $this->description_kz,
            OrganizationContract::DESCRIPTION_EN    =>  $this->description_en,
            OrganizationContract::ADDRESS   =>  $this->address,
            OrganizationContract::ADDRESS_KZ    =>  $this->address_kz,
            OrganizationContract::ADDRESS_EN    =>  $this->address_en,
            OrganizationContract::PRICE =>  $this->price,
            OrganizationContract::TABLES    =>  $this->tables,
            OrganizationContract::MONDAY    =>  [
                OrganizationContract::START =>  $this->start_monday,
                OrganizationContract::END   =>  $this->end_monday
            ],
            OrganizationContract::TUESDAY   =>  [
                OrganizationContract::START =>  $this->start_tuesday,
                OrganizationContract::END   =>  $this->end_tuesday
            ],
            OrganizationContract::WEDNESDAY =>  [
                OrganizationContract::START =>  $this->start_wednesday,
                OrganizationContract::END   =>  $this->end_wednesday
            ],
            OrganizationContract::THURSDAY  =>  [
                OrganizationContract::START =>  $this->start_thursday,
                OrganizationContract::END   =>  $this->end_thursday
            ],
            OrganizationContract::FRIDAY    =>  [
                OrganizationContract::START =>  $this->start_friday,
                OrganizationContract::END   =>  $this->end_friday
            ],
            OrganizationContract::SATURDAY  =>  [
                OrganizationContract::START =>  $this->start_saturday,
                OrganizationContract::END   =>  $this->end_saturday
            ],
            OrganizationContract::SUNDAY    =>  [
                OrganizationContract::START     =>  $this->start_sunday,
                OrganizationContract::END       =>  $this->end_sunday
            ],
            OrganizationContract::STATUS        =>  $this->status,
            OrganizationContract::USER_ID       =>  new UserResource($this->user),
            OrganizationContract::CATEGORY_ID   =>  new CategoryResource($this->category),
            OrganizationContract::IMAGES        =>  new OrganizationImageCollection($this->images),
            OrganizationContract::MENUS         =>  new MenuCollection($this->menus)
        ];
    }
}
