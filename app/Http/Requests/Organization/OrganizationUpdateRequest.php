<?php

namespace App\Http\Requests\Organization;

use App\Domain\Contracts\MainContract;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class OrganizationUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            MainContract::TITLE =>  'nullable|min:1',
            MainContract::DESCRIPTION   =>  'nullable',
            MainContract::DESCRIPTION_KZ    =>  'nullable',
            MainContract::DESCRIPTION_EN    =>  'nullable',
            MainContract::START_MONDAY  =>  'nullable',
            MainContract::END_MONDAY    =>  'nullable',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validated(): array
    {
        return $this->validator->validated();
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
