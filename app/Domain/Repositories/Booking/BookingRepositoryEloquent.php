<?php


namespace App\Domain\Repositories\Booking;

use App\Domain\Contracts\BookingContract;
use App\Models\Booking;

class BookingRepositoryEloquent implements BookingRepositoryInterface
{
    protected $take =   15;
    public function getByUserId($id,$paginate)
    {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::USER_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function getByOrganizationId($id,$paginate)
    {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::ORGANIZATION_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function getByTableId($id,$paginate)
    {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::ORGANIZATION_TABLE_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function create(array $data)
    {
        return Booking::create([
            BookingContract::USER_ID    =>  $data[BookingContract::USER_ID],
            BookingContract::ORGANIZATION_ID    =>  $data[BookingContract::ORGANIZATION_ID],
            BookingContract::ORGANIZATION_TABLE_ID  =>  $data[BookingContract::ORGANIZATION_TABLE_ID],
            BookingContract::START  =>  $data[BookingContract::START],
            BookingContract::END    =>  $data[BookingContract::END],
            BookingContract::DATE   =>  $data[BookingContract::DATE],
            BookingContract::PHONE  =>  array_key_exists(BookingContract::PHONE,$data)?$data[BookingContract::PHONE]:null,
            BookingContract::COMMENT    =>  array_key_exists(BookingContract::COMMENT,$data)?$data[BookingContract::COMMENT]:null,
            BookingContract::STATUS     =>  $data[BookingContract::STATUS],
        ]);
    }
}
