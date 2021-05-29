<?php


namespace App\Services\Booking;

use App\Domain\Contracts\OrganizationContract;
use App\Services\BaseService;

use App\Domain\Repositories\Booking\BookingRepositoryInterface;

use App\Domain\Contracts\BookingContract;

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
        $booking    =   $this->bookingRepository->getLastByTableId($id);

        if ($booking) {
            if ($booking[BookingContract::DATE] === $this->convertDate($booking[BookingContract::ORGANIZATION][OrganizationContract::TIMEZONE],'Y-m-d')) {

                $time       =   (new \DateTime(date('H:i:s')))->modify('+1 day');
                $time->setTimezone(new \DateTimeZone($booking->organization->timezone));
                $beginTime  =   new \DateTime($booking->start);
                $endTime    =   (new \DateTime($booking->end))->modify('+1 day');
                $time       =   \DateTime::createFromFormat('H:i',$time->format('H:i'));
                $beginTime  =   \DateTime::createFromFormat('H:i',$beginTime->format('H:i'));
                $endTime    =   \DateTime::createFromFormat('H:i',$endTime->format('H:i'));
                if ($beginTime <= $time && $time <= $endTime) {

                    if ($booking->status === BookingContract::ENABLED || $booking->status === 'Включен') {
                        return 'paid';
                    } elseif ($booking->status === BookingContract::CHECKING || $booking->status === 'На проверке') {
                        return 'unpaid';
                    }
                } else if ($time < $beginTime) {
                    return $booking->start;
                }
            }
        }
        return 'free';
    }

    public function status($id) {
        $btnList    =   [
            'free'      =>  '<a href="/admin/booking/create?table='.$id.'" class="btn btn-success btn-block text-white font-weight-bold">Свободно</a>',
            'unpaid'    =>  '<a class="btn btn-info btn-block text-white font-weight-bold">В резерве (Не оплачен)</a>',
            'paid'      =>  '<a class="btn btn-danger btn-block text-white font-weight-bold">Забронирован</a>',
        ];
        $status     =   $this->statusCheck($id);
        if (array_key_exists($status,$btnList)) {
            return [$status,$btnList[$status]];
        }
        return ['','<a class="btn btn-warning btn-block text-white font-weight-bold">Свободен до '.$status.'</a>'];
    }
}
