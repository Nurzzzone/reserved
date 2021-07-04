<?php

namespace App\Http\Requests\Booking;

use App\Domain\Contracts\BookingContract;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
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
            BookingContract::USER_ID                    =>  'required|exists:users,id',
            BookingContract::ORGANIZATION_ID            =>  'required|exists:organizations,id',
            BookingContract::ORGANIZATION_TABLE_LIST_ID =>  'required|exists:organization_table_lists,id',
            BookingContract::TIMEZONE                   =>  'required',
            BookingContract::TIME                       =>  'required',
            BookingContract::DATE                       =>  'required|date',
            BookingContract::PRICE                      =>  'required',
            BookingContract::CURRENCY                   =>  'nullable',
            BookingContract::CARD_ID                    =>  'required|integer',
        ];
    }

    public function validated(): array
    {
        $request = $this->validator->validated();
        $request[BookingContract::TIME] =   \App\Helpers\Time\Time::toLocal($request[BookingContract::DATE].' '.$request[BookingContract::TIME],$request[BookingContract::TIMEZONE]);
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
