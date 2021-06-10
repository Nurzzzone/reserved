<?php


namespace App\Domain\Repositories\Booking;

use App\Domain\Contracts\BookingContract;
use App\Models\Booking;
use Carbon\Carbon;

class BookingRepositoryEloquent implements BookingRepositoryInterface
{
    protected $take =   15;

    public function getById($id) {
        return Booking::with('organizationTables','organization')->where(BookingContract::ID,$id)->first();
    }

    public function updateIikoBookingId(int $id, string $iikoId)
    {
        return Booking::where(BookingContract::ID,$id)->update([
            BookingContract::IIKO_BOOKING_ID    =>  $iikoId
        ]);
    }

    public function getByUserId($id,$paginate) {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::USER_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function getByOrganizationId($id,$paginate) {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::ORGANIZATION_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function getByTableId($id,$paginate) {
        return Booking::with('organizationTables','organization')
            ->where(BookingContract::ORGANIZATION_TABLE_LIST_ID,$id)
            ->orderBy(BookingContract::ID,'desc')
            ->skip(--$paginate*$this->take)
            ->take($this->take)->get();
    }

    public function create(array $data) {
        return Booking::create([
            BookingContract::USER_ID    =>  $data[BookingContract::USER_ID],
            BookingContract::ORGANIZATION_ID    =>  $data[BookingContract::ORGANIZATION_ID],
            BookingContract::ORGANIZATION_TABLE_LIST_ID  =>  $data[BookingContract::ORGANIZATION_TABLE_LIST_ID],
            BookingContract::START  =>  $data[BookingContract::START],
            BookingContract::END    =>  $data[BookingContract::END],
            BookingContract::DATE   =>  $data[BookingContract::DATE],
            BookingContract::COMMENT    =>  array_key_exists(BookingContract::COMMENT,$data)?$data[BookingContract::COMMENT]:null,
            BookingContract::STATUS     =>  $data[BookingContract::STATUS],
        ]);
    }

    public function cancel($id) {
        $booking    =   Booking::where(BookingContract::ID,$id)->first();
        $booking->status    =   BookingContract::CANCELED;
        $booking->save();
        return $booking;
    }

    public function success($id):void {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::STATUS =>  BookingContract::ENABLED
        ]);
    }

    public function failure($id):void {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::STATUS =>  BookingContract::CANCELED
        ]);
    }

    public function getLastByTableId($id,$datetime) {
        return Booking::with('organization')->where([
            [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
        ])->whereDate(BookingContract::CREATED_AT,$datetime)->orderBy(BookingContract::ID,'desc')->first();
    }
}
