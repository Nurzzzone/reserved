<?php


namespace App\Domain\Repositories\Booking;

use App\Domain\Contracts\BookingContract;
use App\Models\Booking;
use Carbon\Carbon;

class BookingRepositoryEloquent implements BookingRepositoryInterface
{
    protected $take =   15;

    public function updateIikoId(int $id, string $iikoId):void
    {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::IIKO_BOOKING_ID    =>  $iikoId
        ]);
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function update($id, array $input)
    {
        Booking::where(BookingContract::ID,$id)->update($input);
    }

    public function delete($id):void
    {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::STATUS =>  BookingContract::OFF
        ]);
    }

    public function getById($id)
    {
        return Booking::where([
            [BookingContract::ID,$id],
            [BookingContract::STATUS,'!=',BookingContract::OFF]
        ])->first();
    }

    public function getByUserId($userId,$paginate):object
    {
        return Booking::where([
            [BookingContract::USER_ID,$userId],
            [BookingContract::STATUS,'!=',BookingContract::OFF]
        ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByOrganizationId($organizationId,$paginate):object
    {
        return Booking::where([
            [BookingContract::ORGANIZATION_ID,$organizationId],
            [BookingContract::STATUS,'!=',BookingContract::OFF]
        ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByTableId($tableId,$paginate):object
    {
        return Booking::where([
            [BookingContract::ORGANIZATION_TABLE_LIST_ID,$tableId],
            [BookingContract::STATUS,'!=',BookingContract::OFF]
        ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByDate($date,$paginate):object
    {
        return Booking::where([
            [BookingContract::DATE,$date],
            [BookingContract::STATUS,'!=',BookingContract::OFF]
        ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
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

    public function getLastByTableId($id,$date) {
        return Booking::with('organization')->where([
            [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
        ])->whereDate(BookingContract::DATE,$date)->orderBy(BookingContract::ID,'desc')->first();
    }

}
