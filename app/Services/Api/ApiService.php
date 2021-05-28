<?php


namespace App\Services\Api;

use App\Services\BaseService;
use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\OrganizationTablesContract;
use App\Domain\Repositories\User\UserRepositoryInterface;
use App\Domain\Repositories\Organization\OrganizationRepositoryInterface;
use App\Domain\Repositories\OrganizationTable\OrganizationTableRepositoryInterface;
use App\Domain\Repositories\OrganizationTableList\OrganizationTableListRepositoryInterface;

use App\Helpers\Curl\Curl;

class ApiService extends BaseService
{
//    const USER_ID       =   'api25';
//    const USER_SECRET   =   'Qwerty00';
    const PATH  =   'https://iiko.biz:9900';
    const API   =   '/api/0';
    const URL   =   self::PATH.self::API.'/auth/access_token';
    const URL_ORDER =   self::PATH.self::API.'/orders/add';
    const URL_ORGANIZATION  =   self::PATH.self::API.'/organization/list';
    const URL_SECTIONS  =   self::PATH.self::API.'/rmsSettings/getRestaurantSections';

    const AUTH          =   'https://api-ru.iiko.services/api/1/access_token';
    const ORGANIZATIONS =   'https://api-ru.iiko.services/api/1/organizations';
    const TERMINALS     =   'https://api-ru.iiko.services/api/1/terminal_groups';
    const SECTIONS      =   'https://api-ru.iiko.services/api/1/reserve/available_restaurant_sections';

    public $token;
    protected $userRepository;
    protected $organizationRepository;
    protected $organizationTableRepository;
    protected $organizationTableListRepository;
    protected $curl;

    public function __construct(UserRepositoryInterface $userRepository, OrganizationRepositoryInterface $organizationRepository, OrganizationTableRepositoryInterface $organizationTableRepository, Curl $curl, OrganizationTableListRepositoryInterface $organizationTableListRepository)
    {
        $this->userRepository               =   $userRepository;
        $this->organizationRepository       =   $organizationRepository;
        $this->organizationTableRepository  =   $organizationTableRepository;
        $this->organizationTableListRepository  =   $organizationTableListRepository;
        $this->curl                         =   $curl;
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
        $token          =   $this->getSessionToken($data->api_key);
        $organizations  =   $this->getOrganizationList($token,$data->iiko_organization_id);
        $terminals      =   $this->getTerminalList($token,$organizations);
        $sections       =   $this->getSectionList($token,$terminals);
        foreach ($sections as $key=>$value) {
            $section    =   $this->organizationTableRepository->create($data->id,$key,$value['name']);
            foreach ($value['tables'] as &$table) {
                $this->organizationTableListRepository->create($data->id, $section->id, $table['id'],$table['name'], $table['seatingCapacity']);
            }
        }
    }

    public function getSectionList($token,$terminals):array {
        $arr    =   [];
        $sections   =   json_decode($this->curl->postToken(self::SECTIONS,$token,[
            "terminalGroupIds"  =>  $terminals,
            "returnSchema"      =>  false
        ],false),true);
        if (array_key_exists('restaurantSections',$sections)) {
            foreach ($sections['restaurantSections'] as &$section) {
                $arr[$section['id']]    =   [
                    'name'  =>  $section['name'],
                    'tables'    =>  []
                ];
                if (array_key_exists('tables',$section)) {
                    foreach ($section['tables'] as &$table) {
                        $arr[$section['id']]['tables'][]    =   $table;
                    }
                }
            }
        }
        return $arr;
    }

    public function getTerminalList($token, $organizations):array {
        $arr    =   [];
        $terminals  =   json_decode($this->curl->postToken(self::TERMINALS,$token,[
            "organizationIds"   =>  $organizations,
            "includeDisabled"   =>  true
        ],false),true);
        if (array_key_exists('terminalGroups',$terminals)) {
            foreach ($terminals['terminalGroups'] as &$value) {
                if (array_key_exists('items',$value)) {
                    foreach ($value['items'] as &$item) {
                        $arr[]  =   $item['id'];
                    }
                }
            }
        }
        return $arr;
    }

    public function getOrganizationList($token,$id):array {
        $arr            =   [];
        $organizations  =   json_decode($this->curl->postToken(self::ORGANIZATIONS,$token,[
            "organizationIds"   =>  [
                $id
            ],
            "returnAdditionalInfo"  =>  false,
            "includeDisabled"   =>  false
        ],false),true);
        if (array_key_exists('organizations',$organizations)) {
            foreach ($organizations['organizations'] as &$value) {
                $arr[]  =   $value['id'];
            }
        }
        return $arr;
    }

    public function getSessionToken($key) {
        $token  =   json_decode($this->curl->postToken(self::AUTH,'',[
            'apiLogin'  =>  $key
        ],false),true);
        if (array_key_exists('token',$token)) {
            return $token['token'];
        }
        return [];
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
