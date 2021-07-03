<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Organization\OrganizationService;
use App\Services\OrganizationTable\OrganizationTableService;
use App\Services\OrganizationTableList\OrganizationTableListService;
use App\Services\Booking\BookingService;
use App\Services\User\UserService;

class MainController extends Controller
{

    protected $organizationService;
    protected $organizationTableService;
    protected $organizationTableListService;
    protected $bookingService;
    protected $userService;

    public function __construct(OrganizationService $organizationService, OrganizationTableService $organizationTableService, OrganizationTableListService $organizationTableListService, BookingService $bookingService, UserService $userService) {
        $this->organizationService  =   $organizationService;
        $this->organizationTableService =   $organizationTableService;
        $this->organizationTableListService =   $organizationTableListService;
        $this->bookingService   =   $bookingService;
        $this->userService  =   $userService;
    }

    public function dashboard() {
        return view('vendor.backpack.base.dashboard',[
            'userService'    =>  $this->userService,
            'organizationService'   =>  $this->organizationService,
            'organizationTableService'  =>  $this->organizationTableService,
            'organizationTableListService'  =>  $this->organizationTableListService,
            'bookingService'    =>  $this->bookingService
        ]);
    }

    public function dashboardBooking($id) {
        $table  =   $this->organizationTableListService->getById($id);
        return view('vendor.backpack.base.booking',compact('table'));
    }

    public function index() {
        return view('index');
    }

    public function favorite() {
        return view('index');
    }

    public function top() {
        return view('index');
    }

    public function home() {
        return view('index');
    }

    public function homeRestaurants()
    {
        return view('index');
    }

    public function homeCafe()
    {
        return view('index');
    }

    public function homeBars()
    {
        return view('index');
    }

    public function profile() {
        return view('index');
    }

    public function profileSettings() {
        return view('index');
    }

    public function profilePayments() {
        return view('index');
    }

    public function profileHistory() {
        return view('index');
    }

}
