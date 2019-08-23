<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LocationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $errors,
        ], JsonResponse::HTTP_OK));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'longitude' => 'required|numeric|min:-180|max:180',
            'latitude' => 'required|numeric|min:-90|max:90',
        ];
    }

    public function messages()
    {
        return [
            'longitude.required' => 'необходимый параметр долгота (longitude) отсутствует',
            'longitude.numeric' => 'что-то пошло не так с параметром долгота (longitude) - должно быть число',
            'longitude.min' => 'минимально допустимая долгота -180 градусов',
            'longitude.max' => 'максимально допустимая долгота 180 градусов',
            'latitude.required' => 'необходимый параметр широта (latitude) отсутствует',
            'latitude.numeric' => 'что-то пошло не так с параметром широта (latitude) - должно быть число',
            'latitude.min' => 'минимально допустимая шитора -90 градусов',
            'latitude.max' => 'максимально допустимая шитора 90 градусов',
        ];
    }
}
