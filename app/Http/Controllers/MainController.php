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
use App\Jobs\WebTraffic;

class MainController extends Controller
{

    protected $organizationService;
    protected $organizationTableService;
    protected $organizationTableListService;
    protected $bookingService;
    protected $userService;
    protected $categoryService;
    protected $webTrafficService;

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

    public function entity()
    {
        if (!backpack_auth()->user()->id) {
            redirect('/home/login');
        }
        $organization   =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        return view('backpack.entity.entity',['id'=>$organization->id]);
    }

    public function menus()
    {
        if (!backpack_auth()->user()) {
            redirect('/home/login');
        }
        $organization   =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        return view('backpack.menus.menus',['id'=>$organization->id]);
    }

    public function statistics()
    {
        if (!backpack_auth()->user()) {
            redirect('/home/login');
        }
        $organization   =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        return view('backpack.statistics.statistics',['id'=>$organization->id]);
    }

    public function photos()
    {
        if (!backpack_auth()->user()) {
            redirect('/home/login');
        }
        $organization   =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        return view('backpack.photos.photos',['id'=>$organization->id]);
    }

    public function room()
    {
        if (!backpack_auth()->user()) {
            redirect('/home/login');
        }
        $organization   =   $this->organizationService->getByUserId(backpack_auth()->user()->id);
        return view('backpack.room.room',['id'=>$organization->id]);
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

    public function news()
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
        $organization   =   $this->organizationService->getById($id);

        if ($organization) {
            return view('index', [
                'title' =>  $organization->{MainContract::TITLE}
            ]);
        }

        WebTraffic::dispatch(
            date('Y-m-d'),
            $id,
            $this->webTrafficService->getRealIpAddress(),
            $this->webTrafficService->getReferer()
        );

        return view('index',[
            'title' =>  'Не найдено'
        ]);
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
