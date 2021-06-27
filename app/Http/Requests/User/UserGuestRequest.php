<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

use App\Domain\Contracts\UserContract;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Helpers\Random\Random;

class UserGuestRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            UserContract::NAME  =>  'required|min:2|max:255',
            UserContract::PHONE =>  'required|max:255',
        ];
    }

    public function validated(): array
    {
        $request    =   $this->validator->validated();
        $request[UserContract::PASSWORD]    =   Random::generate(8);
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
