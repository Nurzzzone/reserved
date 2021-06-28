<?php


namespace App\Services\Booking;


use App\Services\BaseService;

use App\Domain\Repositories\Booking\BookingRepositoryInterface;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationContract;
use Carbon\Carbon;
use http\Env\Request;

class BookingService extends BaseService
{
    protected $bookingRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository    =   $bookingRepository;
    }

    public function delete($id):void
    {
        $this->bookingRepository->delete($id);
    }

    public function getById($id)
    {
        return $this->bookingRepository->getById($id);
    }

    public function getByUserId($userId,int $paginate):object
    {
        return $this->bookingRepository->getByUserId($userId,$paginate);
    }

    public function getByOrganizationId($organizationId, int $paginate):object
    {
        return $this->bookingRepository->getByOrganizationId($organizationId,$paginate);
    }

    public function getByTableId($tableId, int $paginate):object
    {
        return $this->bookingRepository->getByTableId($tableId, $paginate);
    }

    public function getByDate($date, int $paginate):object
    {
        return $this->bookingRepository->getByDate($date, $paginate);
    }

    public function create(array $input)
    {
        return $this->bookingRepository->create($input);
    }

    public function update($id, array $input)
    {
        $this->bookingRepository->update($id,$input);
    }

    public function cancel($id) {
        return $this->bookingRepository->cancel($id);
    }

    public function result($data):bool {
        if ((int) $data[BookingContract::PG_RESULT] === 1) {
            $this->bookingRepository->success($data[BookingContract::PG_ORDER_ID]);
            return true;
        }
        $this->bookingRepository->failure($data[BookingContract::PG_ORDER_ID]);
        return false;
    }

    public function convertDate($timezone,$format) {
        $timestamp = time();
        $dt = new \DateTime(date('Y-m-d'), new \DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);
        return $dt->format($format);
    }

    public function statusCheck($id, $date  =   '') {
        if (!$date) {
            $date   =   date('Y-m-d');
        }
        $booking    =   $this->bookingRepository->getLastByTableId($id,$date);
        if ($booking) {
            if ($booking[BookingContract::STATUS] === BookingContract::ON) {
                return [
                    BookingContract::STATUS =>  BookingContract::ON,
                    BookingContract::TIME   =>  $booking[BookingContract::TIME],
                    BookingContract::ID     =>  $booking[BookingContract::ID],
                ];
            } elseif ($booking[BookingContract::STATUS] === BookingContract::CHECKING) {
                return [
                    BookingContract::STATUS =>  BookingContract::CHECKING,
                    BookingContract::TIME   =>  $booking[BookingContract::TIME],
                    BookingContract::ID     =>  $booking[BookingContract::ID],
                ];
            }
        }
        return [
            BookingContract::STATUS =>  'free',
        ];
    }

    public function status($id, $date   =   '') {
        if (!$date) {
            $date   =   date('Y-m-d');
        }
        $status     =   $this->statusCheck($id,$date);
        if ($status[BookingContract::STATUS] === BookingContract::ON) {
            return [BookingContract::ON,'<a class="btn btn-danger btn-block text-white font-weight-bold">Забронирован ('.$status[BookingContract::TIME].')</a><a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="'.$status[BookingContract::ID].'">Отменить</a>',$status[BookingContract::ID]];
        } elseif ($status[BookingContract::STATUS] === BookingContract::CHECKING) {
            return [BookingContract::CHECKING,'<a class="btn btn-info btn-block text-white font-weight-bold">В резерве ('.$status[BookingContract::TIME].')</a><a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="'.$status[BookingContract::ID].'">Отменить</a>',$status[BookingContract::ID]];
        }
        return ['free','<a href="/admin/booking/create?table='.$id.'" class="btn btn-success btn-block text-white font-weight-bold booking-new-btn" data-toggle="modal" data-target="#booking-modal" data-id="'.$id.'">Свободно</a>'];
    }
}
