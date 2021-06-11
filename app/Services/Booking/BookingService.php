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

    public function __construct(BookingRepositoryInterface $bookingRepository) {
        $this->bookingRepository    =   $bookingRepository;
    }

    public function getByUserId($id,$paginate) {
        return $this->bookingRepository->getByUserId($id,$paginate);
    }

    public function getByTableId($id,$paginate) {
        return $this->bookingRepository->getByTableId($id,$paginate);
    }

    public function getByOrganizationId($id, $paginate) {
        return $this->bookingRepository->getByOrganizationId($id,$paginate);
    }

    public function create(array $data) {
        return $this->bookingRepository->create($data);
    }

    public function cancel($id) {
        return $this->bookingRepository->cancel($id);
    }

    public function result($data):bool {
        if (array_key_exists(BookingContract::PG_RESULT,$data)) {
            if ((int) $data[BookingContract::PG_RESULT] === 1) {
                $this->bookingRepository->success($data[BookingContract::PG_ORDER_ID]);
                return true;
            } else {
                $this->bookingRepository->failure($data[BookingContract::PG_ORDER_ID]);
            }
        }
        return false;
    }

    public function convertDate($timezone,$format) {
        $timestamp = time();
        $dt = new \DateTime(date('Y-m-d'), new \DateTimeZone($timezone));
        $dt->setTimestamp($timestamp);
        return $dt->format($format);
    }

    public function statusCheck($id) {
        $booking    =   $this->bookingRepository->getLastByTableId($id,date('Y-m-d'));
        if ($booking) {
            if ($booking[BookingContract::STATUS] === 'Включен') {
                return [
                    BookingContract::STATUS =>  BookingContract::ENABLED,
                    BookingContract::TIME   =>  $booking[BookingContract::TIME],
                    BookingContract::ID     =>  $booking[BookingContract::ID],
                ];
            } elseif ($booking[BookingContract::STATUS] === 'На проверке') {
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

    public function status($id) {
        $status     =   $this->statusCheck($id);
        if ($status[BookingContract::STATUS] === BookingContract::ENABLED) {
            return [BookingContract::ENABLED,'<a class="btn btn-danger btn-block text-white font-weight-bold">Забронирован ('.$status[BookingContract::TIME].')</a><a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="'.$status[BookingContract::ID].'">Отменить</a>',$status[BookingContract::ID]];
        } elseif ($status[BookingContract::STATUS] === BookingContract::CHECKING) {
            return [BookingContract::CHECKING,'<a class="btn btn-info btn-block text-white font-weight-bold">В резерве ('.$status[BookingContract::TIME].')</a><a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="'.$status[BookingContract::ID].'">Отменить</a>',$status[BookingContract::ID]];
        }
        return ['free','<a href="/admin/booking/create?table='.$id.'" class="btn btn-success btn-block text-white font-weight-bold">Свободно</a>'];
    }
}
