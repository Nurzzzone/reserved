<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\BookingContract;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookingCreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            BookingContract::USER_ID                =>  'required|exists:users,id',
            BookingContract::ORGANIZATION_ID        =>  'required',
            BookingContract::ORGANIZATION_TABLE_ID  =>  'required',
            BookingContract::TIME                   =>  'required',
            BookingContract::DATE                   =>  'required|date',
            BookingContract::COMMENT                =>  'nullable'
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
