<?php


namespace App\Services\Booking;


use App\Services\BaseService;

use App\Domain\Repositories\Booking\BookingRepositoryInterface;
use App\Domain\Repositories\Organization\OrganizationRepositoryInterface;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationContract;
use Carbon\Carbon;
use http\Env\Request;

class BookingService extends BaseService
{
    protected $bookingRepository;
    protected $organizationRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository, OrganizationRepositoryInterface $organizationRepository)
    {
        $this->bookingRepository    =   $bookingRepository;
        $this->organizationRepository   =   $organizationRepository;
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

    public function getLastByTableId($id, $date) {
        $date   =   date('Y-m-d',strtotime($date));
        return $this->bookingRepository->getLastByTableId($id, $date);
    }
}
