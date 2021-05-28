<?php


namespace App\Services\Booking;

use App\Domain\Contracts\BookingContract;
use App\Services\BaseService;
use App\Domain\Repositories\Booking\BookingRepositoryInterface;
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

    public function result($data):void {
        if (array_key_exists(BookingContract::PG_RESULT,$data)) {
            if ((int) $data[BookingContract::PG_RESULT] === 1) {
                $this->bookingRepository->success($data[BookingContract::PG_ORDER_ID]);
            } else {
                $this->bookingRepository->failure($data[BookingContract::PG_ORDER_ID]);
            }
        }
    }

    public function statusCheck($id) {
        $booking    =   $this->bookingRepository->getLastByTableId($id,date('Y-m-d'));
        if ($booking) {
            //$start  =   new \DateTime($parameter[BookingContract::DATE].' '.$parameter[BookingContract::START].':00', );
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
        return 'free';
    }

    public function status($id) {
        $btnList    =   [
            'free'      =>  '<a href="/admin/booking/create?table='.$id.'"><button class="btn btn-success btn-sm">Свободен</button></a>',
            'unpaid'    =>  '<button class="btn btn-sm btn-info">В резерве (Не оплачен)</button>',
            'paid'      =>  '<button class="btn btn-sm btn-danger">Забронирован</button>',
        ];
        $status     =   $this->statusCheck($id);
        if (array_key_exists($status,$btnList)) {
            return $btnList[$status];
        }
        return '<button class="btn btn-sm btn-warning">Свободен до '.$status.'</button>';
    }
}
