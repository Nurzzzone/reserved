<?php

namespace App\Http\Controllers\Api;

use App\Domain\Contracts\BookingContract;
use App\Domain\Contracts\ReviewContract;
use App\Events\BookingNotification;
use App\Http\Controllers\Controller;

use App\Http\Resources\ReviewCollection;

use App\Models\Booking;
use Illuminate\Http\Request;

use App\Services\Review\ReviewService;
use App\Services\Booking\BookingService;

use App\Events\ReviewCreated;

use App\Http\Resources\ReviewResource;
use App\Http\Requests\Review\ReviewCreateRequest;

use App\Jobs\TelegramReviewNotification;

class ReviewController extends Controller
{
    protected $paginate =   1;
    protected $reviewService;
    protected $bookingService;
    public function __construct(ReviewService $reviewService, BookingService $bookingService)
    {
        $this->reviewService    =   $reviewService;
        $this->bookingService   =   $bookingService;
    }

    public function create(ReviewCreateRequest $reviewCreateRequest)
    {
        $review     =   $this->reviewService->create($reviewCreateRequest->validated());
        $this->bookingService->update($review->{ReviewContract::BOOKING_ID},[
            BookingContract::COMMENT    =>  BookingContract::OFF
        ]);
        event(new ReviewCreated($review));
        $booking    =   Booking::with('organization','organizationTables')->where(BookingContract::ID,$review->{ReviewContract::BOOKING_ID})->first();
        event(new BookingNotification($booking));
        TelegramReviewNotification::dispatch($review, $booking);
        return new ReviewResource($this->reviewService->getById($review->id));
    }

    public function update($id, Request $request)
    {
        $this->reviewService->update($id,$request->all());
        return new ReviewResource($this->reviewService->getById($id));
    }

    public function delete($id)
    {
        $this->reviewService->delete($id);
        $review =   $this->reviewService->getById($id);
        event(new ReviewCreated($review));
        return new ReviewResource($review);
    }

    public function getCountByOrganizationId($organizationId)
    {
        return $this->reviewService->getCountByOrganizationId($organizationId);
    }

    public function getByOrganizationId(int $id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new ReviewCollection($this->reviewService->getByOrganizationId($id,$this->paginate));
    }

    public function getByUserId(int $id, Request $request)
    {
        if ($request->has('paginate')) {
            $this->paginate =   (int)$request->input('paginate');
        }
        return new ReviewCollection($this->reviewService->getByUserId($id,$this->paginate));
    }
}
