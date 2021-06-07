<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Contracts\UserContract;

class UserResource extends JsonResource
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
            UserContract::ID    =>  $this->id,
            UserContract::BLOCKED   =>  $this->blocked,
            UserContract::NAME      =>  $this->name,
            UserContract::AVATAR    =>  $this->avatar,
            UserContract::PHONE     =>  $this->phone,
            UserContract::PHONE_VERIFIED_AT =>  $this->phone_verified_at,
            UserContract::EMAIL     =>  $this->email,
            UserContract::EMAIL_VERIFIED_AT =>  $this->email_verified_at,
            UserContract::API_TOKEN =>  $this->api_token
        ];
    }
}
