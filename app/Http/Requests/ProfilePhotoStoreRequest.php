<?php

namespace App\Http\Requests;

use App\ProfilePhoto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'toomuch.required' => 'You have more than 9 photos in your "photo album"',
            'mainPhoto_id.in' => 'Nice try! Please, reload page and try again ;)',
            'file.image' => 'It is not image',
            'file.mimes' => 'It is still not photo',
            'count.required' => 'Some field must be here. Please, reload page and try again ;)',
            'count.integer' => 'Some field must be only numeric. Please, reload page and try again ;)',
            'count.min' => 'Some field must be only numeric and more than 0. Please, reload page and try again ;)',
            'count.max' => 'Only 9 photos can be here. Please, reload page and try again ;)',
        ];
    }
}
