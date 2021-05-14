<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\ReviewContract;

class ReviewResource extends JsonResource
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
            ReviewContract::ID              =>  $this->id,
            ReviewContract::ORGANIZATION    =>  new OrganizationResource($this->organization),
            ReviewContract::USER            =>  new UserResource($this->user),
            ReviewContract::RATING          =>  $this->rating,
            ReviewContract::COMMENT         =>  $this->comment,
            ReviewContract::STATUS          =>  $this->status,
        ];
    }
}
