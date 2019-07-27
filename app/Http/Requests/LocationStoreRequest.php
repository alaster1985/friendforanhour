<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'longitude.required' => 'you must set your geo chords (longitude)',
            'longitude.numeric' => 'something went wrong with longitude numeric format',
            'longitude.min' => 'min longitude is -180 degrees',
            'longitude.max' => 'max longitude is 180 degrees',
            'latitude.required' => 'you must set your geo chords (latitude)',
            'latitude.numeric' => 'something went wrong with latitude numeric format',
            'latitude.min' => 'min latitude is -90 degrees',
            'latitude.max' => 'max latitude is 90 degrees',
        ];
    }
}
