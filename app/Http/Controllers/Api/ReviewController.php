<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewCollection;
use Illuminate\Http\Request;
use App\Services\Review\ReviewService;
use App\Events\ReviewCreated;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    protected $paginate =   1;
    protected $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService    =   $reviewService;
    }

    public function create(Request $request)
    {
        $review =   $this->reviewService->create($request->all());
        event(new ReviewCreated($review));
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
