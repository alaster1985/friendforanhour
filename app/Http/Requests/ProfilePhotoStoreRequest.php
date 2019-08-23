<?php

namespace App\Http\Requests;

use App\ProfilePhoto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;


class ProfilePhotoStoreRequest extends FormRequest
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
        $profilePhotoIds = ProfilePhoto::getAllPhotosByProfileId(Auth::user()->profile_id ?? $this->request->get('profileId'))->pluck('id')->all() ?? [];
        if (count($profilePhotoIds) > 9) {
            return ['toomuch' => 'required'];
        }
        $rules = [
            'mainPhoto_id' => [
                'nullable',
                Rule::in($profilePhotoIds)
            ],
            'file' => 'nullable|image|mimes:jpeg,bmp,png',
            'count' => 'required|integer|min:0|max:10',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'toomuch.required' => 'у вас более 9 фото в Вашем альбоме',
            'mainPhoto_id.in' => 'Nice try! Please, reload page and try again ;)',
            'file.image' => 'Загружаемый файл не яляется изображением (img)',
            'file.mimes' => 'Загружаемый файл не яляется изображением (mime)',
            'count.required' => 'Одно из необходимых полей отсутствует. Пожалуйста, перезагрузите страницу и попробуйте снова',
            'count.integer' => 'Одно из необходимых полей не является числом. Пожалуйста, перезагрузите страницу и попробуйте снова',
            'count.min' => 'Одно из необходимых полей не может быть отрицательным числом. Пожалуйста, перезагрузите страницу и попробуйте снова',
            'count.max' => 'Только 9 изображений можно загрузить. Пожалуйста, перезагрузите страницу и попробуйте снова',
        ];
    }
}
