<?php


namespace App\Services\Booking;

use App\Domain\Contracts\BookingContract;
use App\Services\BaseService;
use App\Domain\Repositories\Booking\BookingRepositoryInterface;

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
}
