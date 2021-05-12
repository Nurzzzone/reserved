<?php


namespace App\Services\Api;

use App\Services\BaseService;
use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Domain\Repositories\Organization\OrganizationRepositoryInterface;
use App\Domain\Repositories\OrganizationTable\OrganizationTableRepositoryInterface;

class ApiService extends BaseService
{
//    const USER_ID       =   'api25';
//    const USER_SECRET   =   'Qwerty00';
    const PATH          =   'https://iiko.biz:9900';
    const API           =   '/api/0';
    const URL           =   self::PATH.self::API.'/auth/access_token';
    const URL_ORDER     =   self::PATH.self::API.'/orders/add';
    const URL_ORGANIZATION  =   self::PATH.self::API.'/organization/list';
    const URL_SECTIONS      =   self::PATH.self::API.'/rmsSettings/getRestaurantSections';
    public $token;
    protected $userRepository;
    protected $organizationRepository;
    protected $organizationTableRepository;

    public function __construct(UserRepositoryInterface $userRepository, OrganizationRepositoryInterface $organizationRepository, OrganizationTableRepositoryInterface $organizationTableRepository)
    {
        $this->userRepository               =   $userRepository;
        $this->organizationRepository       =   $organizationRepository;
        $this->organizationTableRepository  =   $organizationTableRepository;
    }

    public function getOrganizationId(string $id,string $secret)
    {
        return $this->getOrganizations($this->getToken($id,$secret));
    }

    public function booking($data)
    {
        $organization   =   $this->organizationRepository->getById($data[BookingContract::ORGANIZATION_ID]);
        $token          =   $this->getToken($organization->api_id,$organization->api_secret);
    }

    public function createOrder()
    {
        $url    =   self::URL_ORDER.'?access_token='.$this->token.'&request_timeout=15';
    }

    public function getRooms($data)
    {
        $token  =   $this->getToken($data->api_id,$data->api_secret);
        $rooms  =   $this->curlGet(self::URL_SECTIONS.'?access_token='.$token.'&organization='.$data->iiko_organization_id);
        if ($rooms) {
            $rooms    =   json_decode($rooms,true);
            foreach ($rooms['sections'] as &$room) {
                $this->organizationTableRepository->create($data->id,$room[OrganizationTablesContract::ID],$room[OrganizationTablesContract::NAME]);
            }
        }
    }

    public function getOrganizations(string $token)
    {
        $organizations  =   $this->curlGet(self::URL_ORGANIZATION.'?access_token='.$token);
        if ($organizations) {
            return json_decode($organizations,true)[0];
        }
        return [];
    }

    public function getToken($id,$secret)
    {
        if (!$this->token) {
            $this->token    =   str_replace('"', '', $this->curlGet(self::URL.'?user_id='.$id.'&user_secret='.$secret));
        }
        return $this->token;
    }

    public function curlGet(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
