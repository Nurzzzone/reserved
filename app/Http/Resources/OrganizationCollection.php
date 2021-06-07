<?php

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\OrganizationImage;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Domain\Contracts\OrganizationContract;

class OrganizationCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                OrganizationContract::ID    =>  $item->id,
                OrganizationContract::RATING    =>  $item->rating,
                OrganizationContract::IMAGE =>  $item->photo,
                OrganizationContract::TITLE =>  $item->title,
                OrganizationContract::TITLE_KZ  =>  $item->title_kz,
                OrganizationContract::TITLE_EN  =>  $item->title_en,
                OrganizationContract::DESCRIPTION   =>  $item->description,
                OrganizationContract::DESCRIPTION_KZ    =>  $item->description_kz,
                OrganizationContract::DESCRIPTION_EN    =>  $item->description_en,
                OrganizationContract::ADDRESS   =>  $item->address,
                OrganizationContract::ADDRESS_KZ    =>  $item->address_kz,
                OrganizationContract::ADDRESS_EN    =>  $item->address_en,
                OrganizationContract::PRICE =>  $item->price,
                OrganizationContract::TABLES    =>  $item->tables,
                OrganizationContract::MONDAY    =>  [
                    OrganizationContract::START =>  $item->start_monday,
                    OrganizationContract::END   =>  $item->end_monday
                ],
                OrganizationContract::TUESDAY   =>  [
                    OrganizationContract::START =>  $item->start_tuesday,
                    OrganizationContract::END   =>  $item->end_tuesday
                ],
                OrganizationContract::WEDNESDAY =>  [
                    OrganizationContract::START =>  $item->start_wednesday,
                    OrganizationContract::END   =>  $item->end_wednesday
                ],
                OrganizationContract::THURSDAY  =>  [
                    OrganizationContract::START =>  $item->start_thursday,
                    OrganizationContract::END   =>  $item->end_thursday
                ],
                OrganizationContract::FRIDAY    =>  [
                    OrganizationContract::START =>  $item->start_friday,
                    OrganizationContract::END   =>  $item->end_friday
                ],
                OrganizationContract::SATURDAY  =>  [
                    OrganizationContract::START =>  $item->start_saturday,
                    OrganizationContract::END   =>  $item->end_saturday
                ],
                OrganizationContract::SUNDAY    =>  [
                    OrganizationContract::START =>  $item->start_sunday,
                    OrganizationContract::END   =>  $item->end_sunday
                ],
                OrganizationContract::STATUS    =>  $item->status,
                OrganizationContract::USER_ID   =>  new UserResource($item->user),
                OrganizationContract::CATEGORY_ID   =>  new CategoryResource($item->category),
                OrganizationContract::IMAGES    =>  new OrganizationImageCollection($item->images)
            ];
        });
    }
}
