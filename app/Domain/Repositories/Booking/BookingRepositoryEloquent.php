<?php


namespace App\Domain\Repositories\Booking;

use App\Domain\Contracts\BookingContract;
use App\Helpers\Time\Time;
use App\Models\Booking;
use Carbon\Carbon;
use DateTime;

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
        $booking    =   Booking::create($data);
        return $this->getById($booking->{BookingContract::ID});
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
        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::ID,$id],
                [BookingContract::STATUS,BookingContract::ON]
            ])
            ->orWhere([
                [BookingContract::ID,$id],
                [BookingContract::STATUS,BookingContract::CAME],
            ])
            ->orWhere([
                [BookingContract::ID,$id],
                [BookingContract::STATUS,BookingContract::COMPLETED],
            ])
            ->orWhere([
                [BookingContract::ID,$id],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',$this->date]
            ])->first();
    }

    public function getByUserId($userId,$paginate):object
    {
        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::USER_ID,$userId],
                [BookingContract::STATUS,BookingContract::ON]
            ])
            ->orWhere([
                [BookingContract::USER_ID,$userId],
                [BookingContract::STATUS,BookingContract::CAME],
            ])
            ->orWhere([
                [BookingContract::USER_ID,$userId],
                [BookingContract::STATUS,BookingContract::COMPLETED],
            ])
            ->orWhere([
                [BookingContract::USER_ID,$userId],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',$this->date]
            ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByOrganizationId($organizationId,$paginate):object
    {
        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::ORGANIZATION_ID,$organizationId],
                [BookingContract::STATUS,BookingContract::ON]
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_ID,$organizationId],
                [BookingContract::STATUS,BookingContract::CAME],
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_ID,$organizationId],
                [BookingContract::STATUS,BookingContract::COMPLETED],
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_ID,$organizationId],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',$this->date]
            ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByTableId($tableId,$paginate):object
    {
        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$tableId],
                [BookingContract::STATUS,BookingContract::ON]
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$tableId],
                [BookingContract::STATUS,BookingContract::CAME],
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$tableId],
                [BookingContract::STATUS,BookingContract::COMPLETED],
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$tableId],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',$this->date]
            ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function getByDate($date,$paginate,$organization):object
    {
        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::DATE,$date],
                [BookingContract::STATUS,BookingContract::ON]
            ])
            ->orWhere([
                [BookingContract::DATE,$date],
                [BookingContract::STATUS,BookingContract::CAME],
            ])
            ->orWhere([
                [BookingContract::DATE,$date],
                [BookingContract::STATUS,BookingContract::COMPLETED],
            ])
            ->orWhere([
                [BookingContract::DATE,$date],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',$this->date]
            ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->skip($paginate * $this->take)
            ->take($this->take)->get();
    }

    public function success($id):void {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::STATUS =>  BookingContract::ON
        ]);
    }

    public function failure($id):void {
        Booking::where(BookingContract::ID,$id)->update([
            BookingContract::STATUS =>  BookingContract::OFF
        ]);
    }

    public function getLastByTableId($id,$date,$timezone) {

        return Booking::with('organization','organizationTables')
            ->where([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
                [BookingContract::STATUS,BookingContract::ON],
                [BookingContract::DATE,$date]
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
                [BookingContract::STATUS,BookingContract::CAME],
                [BookingContract::DATE,$date]
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
                [BookingContract::STATUS,BookingContract::COMPLETED],
                [BookingContract::DATE,$date]
            ])
            ->orWhere([
                [BookingContract::ORGANIZATION_TABLE_LIST_ID,$id],
                [BookingContract::STATUS,BookingContract::CHECKING],
                [BookingContract::CREATED_AT,'>=',Time::currentTimestampTimezone($timezone)],
                [BookingContract::DATE,$date]
            ])
            ->orderBy(BookingContract::ID,BookingContract::DESC)
            ->first();
    }

}
