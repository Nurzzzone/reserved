<?php


namespace App\Domain\Repositories\Review;

use App\Models\Review;
use App\Domain\Contracts\ReviewContract;

class ReviewRepositoryEloquent implements ReviewRepositoryInterface
{
    private $take   =   15;
    public function create($data)
    {
        return Review::create($data);
    }

    public function update($id,$data)
    {
        return Review::where(ReviewContract::ID,$id)->update([
            ReviewContract::RATING  =>  $data[ReviewContract::RATING],
            ReviewContract::COMMENT =>  $data[ReviewContract::COMMENT],
        ]);
    }

    public function delete($id):void
    {
        Review::where(ReviewContract::ID,$id)->update([
            ReviewContract::STATUS  =>  ReviewContract::DISABLED
        ]);
    }

    public function getByOrganizationId($id,$paginate)
    {
        return Review::with('organization','user')
            ->where(ReviewContract::ORGANIZATION_ID,$id)->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function getByUserId($id,$paginate)
    {
        return Review::with('organization','user')
            ->where(ReviewContract::USER_ID,$id)->skip(--$paginate * $this->take)->take($this->take)->get();
    }

    public function getById($id)
    {
        return Review::with('organization','user')->where(ReviewContract::ID,$id)->first();
    }

    public function sumRating($id)
    {
        $reviews    =   Review::select(ReviewContract::RATING)->where([
            [ReviewContract::ORGANIZATION_ID,$id],
            [ReviewContract::STATUS,ReviewContract::ENABLED]
        ])->get();
        if (sizeof($reviews)>0) {
            $count      =   0;
            $sum        =   0;
            foreach ($reviews as &$review) {
                $sum    +=  $review->rating;
                $count++;
            }
            return round(($sum/$count),1);
        }
        return null;
    }
}
