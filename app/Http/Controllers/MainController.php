<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Organization\OrganizationService;
use App\Services\OrganizationTable\OrganizationTableService;
use App\Services\OrganizationTableList\OrganizationTableListService;
use App\Services\Booking\BookingService;
use mysql_xdevapi\Table;

class MainController extends Controller
{
    protected $organization;
    protected $organizationTable;
    protected $organizationTableList;
    protected $booking;
    public function __construct(OrganizationService $organization, OrganizationTableService $organizationTable, OrganizationTableListService $organizationTableList, BookingService $booking) {
        $this->organization             =   $organization;
        $this->organizationTable        =   $organizationTable;
        $this->organizationTableList    =   $organizationTableList;
        $this->booking                  =   $booking;
    }

    public function dashboard() {
        $organizations  =   $this->organization;
        $sections       =   $this->organizationTable;
        $tables         =   $this->organizationTableList;
        $booking        =   $this->booking;
        return view('vendor.backpack.base.dashboard',compact('organizations', 'sections','tables','booking'));
    }

    public function dashboardBooking($id) {
        $table  =   $this->organizationTableList->getById($id);
        return view('vendor.backpack.base.booking',compact('table'));
    }

    public function index() {
        return view('index');
    }
}
