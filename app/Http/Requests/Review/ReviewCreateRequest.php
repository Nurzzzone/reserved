<?php

namespace App\Http\Requests\Review;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Domain\Contracts\ReviewContract;

class ReviewCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            ReviewContract::BOOKING_ID        =>  'required|exists:bookings,id',
            ReviewContract::ORGANIZATION_ID   =>  'required|exists:organizations,id',
            ReviewContract::USER_ID           =>  'required|exists:users,id',
            ReviewContract::RATING            =>  'required|integer',
            ReviewContract::COMMENT           =>  'required',
        ];
    }

    public function validated(): array
    {
        $request = $this->validator->validated();
        return $request;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];
        throw new HttpResponseException(response()->json($response, 400));
    }
}
