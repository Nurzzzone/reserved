<?php

namespace App\Http\Controllers;

use App\Domain\Contracts\MainContract;
use Illuminate\Http\Request;
use App\Services\Organization\OrganizationService;
use App\Services\OrganizationTable\OrganizationTableService;
use App\Services\OrganizationTableList\OrganizationTableListService;
use App\Services\Booking\BookingService;
use App\Services\User\UserService;
use App\Services\Category\CategoryService;

class MainController extends Controller
{

    protected $organizationService;
    protected $organizationTableService;
    protected $organizationTableListService;
    protected $bookingService;
    protected $userService;
    protected $categoryService;

    public function __construct(OrganizationService $organizationService, OrganizationTableService $organizationTableService, OrganizationTableListService $organizationTableListService, BookingService $bookingService, UserService $userService, CategoryService $categoryService) {
        $this->organizationService  =   $organizationService;
        $this->organizationTableService =   $organizationTableService;
        $this->organizationTableListService =   $organizationTableListService;
        $this->bookingService   =   $bookingService;
        $this->userService  =   $userService;
        $this->categoryService  =   $categoryService;
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

    public function dashboardBooking($id)
    {
        $table  =   $this->organizationTableListService->getById($id);
        return view('vendor.backpack.base.booking',compact('table'));
    }

    public function index()
    {
        return view('index',['title'=>'Reserved | Добро пожаловать']);
    }

    public function favorite()
    {
        return view('index', ['title'=>'Избранное']);
    }

    public function top()
    {
        return view('index', ['title'=>'Новости']);
    }

    public function home()
    {
        return view('index', ['title'=>'Категории']);
    }

    public function category($slug)
    {
        $category   =   $this->categoryService->getBySlug($slug);
        if ($category) {
            return view('index', ['title'=>$category->{MainContract::TITLE}]);
        }
        return view('index',[
            'title'=>'Не найдено'
        ]);
    }

    public function getOrganizationById($slug,$id)
    {
        $category   =   $this->categoryService->getBySlug($slug);
        $organization   =   $this->organizationService->getById($id);
        if ($category && $organization) {
            return view('index', [
                'title'=>$organization->{MainContract::TITLE}
            ]);
        }
        return view('index',['title'=>'Не найдено']);
    }

    public function profile()
    {
        return view('index', ['title'=>'Профиль']);
    }

    public function form()
    {
        return view('index', ['title'=>'Заявка для ресторанов']);
    }

    public function profileSettings()
    {
        return view('index', ['title'=>'Уведомления']);
    }

    public function profilePayments()
    {
        return view('index', ['title'=>'Способ оплаты']);
    }

    public function profileHistory()
    {
        return view('index', ['title'=>'История бронирования']);
    }

}
