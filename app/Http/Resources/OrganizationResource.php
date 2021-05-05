<?php

namespace App\Http\Resources;

use App\Domain\Contracts\OrganizationContract;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            OrganizationContract::ID    =>  $this->id,
            OrganizationContract::RATING    =>  $this->rating,
            OrganizationContract::IMAGE =>  $this->photo,
            OrganizationContract::TITLE =>  $this->title,
            OrganizationContract::TITLE_KZ  =>  $this->title_kz,
            OrganizationContract::TITLE_EN  =>  $this->title_en,
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
                OrganizationContract::START =>  $this->start_sunday,
                OrganizationContract::END   =>  $this->end_sunday
            ],
            OrganizationContract::STATUS    =>  $this->status,
            OrganizationContract::USER_ID   =>  new UserResource($this->user),
            OrganizationContract::CATEGORY_ID   =>  new CategoryResource($this->category),
            OrganizationContract::IMAGES    =>  new OrganizationImageCollection($this->images)
        ];
    }
}
