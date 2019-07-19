<?php

namespace App\Http\Requests;

use App\City;
use App\Gender;
use App\ServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
            'min_age' => 'nullable|integer|lte:max_age|min:18|max:123',
            'max_age' => 'nullable|integer|min:18|max:123',
            'longitude' => 'nullable|numeric|min:-180|max:180',
            'latitude' => 'nullable|numeric|min:-90|max:90',
            'friend_type' => [
                'required',
                Rule::in(ServiceType::pluck('id')->all())
            ],
            'min_money' => 'nullable|integer|lte:max_money|min:0|max:10000',
            'max_money' => 'nullable|integer|min:0|max:10000',
            'radius' => 'nullable|integer|min:1|max:25',
            'city' => [
                'nullable',
                Rule::in(City::pluck('id')->all())
            ],
            'gender' => [
                'required',
                Rule::in(Gender::pluck('id')->all())
            ],
            'min_height' => 'nullable|integer|lte:max_height|min:130|max:220',
            'max_height' => 'nullable|integer|min:130|max:220',
            'min_weight' => 'nullable|integer|lte:max_weight|min:30|max:280',
            'max_weight' => 'nullable|integer|min:30|max:280',
            'online' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'min_age.integer' => 'Use only numbers for min age',
            'min_age.lte' => 'min age can\'t be more than max age',
            'min_age.min' => 'not less than 18 years old for min age',
            'min_age.max' => 'I think it\'s to old for you. Any way there are no such old users here (for min age field)',
            'max_age.integer' => 'Use only numbers for max age',
            'max_age.min' => 'not less than 18 years old for max age',
            'max_age.max' => 'I think it\'s to old for you. Any way there are no such old users here (for max age field)',
//            'longitude.required' => 'you must set your geo chords (longitude)',
            'longitude.numeric' => 'something went wrong with longitude numeric format',
            'longitude.min' => 'min longitude is -180 degrees',
            'longitude.max' => 'max longitude is 180 degrees',
//            'latitude.required' => 'you must set your geo chords (latitude)',
            'latitude.numeric' => 'something went wrong with latitude numeric format',
            'latitude.min' => 'min latitude is -90 degrees',
            'latitude.max' => 'max latitude is 90 degrees',
            'friend_type.required' => 'you must choose who you are looking for: friend or sponsor',
            'friend_type.in' => 'nice try bro ;) but you must use only this select for type of "friend". Tnx!',
            'min_money.integer' => 'Use only numbers for min money field',
            'min_money.lte' => 'min money value can\'t be more than max money value',
            'min_money.min' => 'not less than 0 for min money value',
            'min_money.max' => 'I think it\'s to much. Any way there are no such price here (for min money field)',
            'max_money.integer' => 'Use only numbers for max money field',
            'max_money.min' => 'not less than 0 for max money value',
            'max_money.max' => 'I think it\'s to much. Any way there are no such price here (for max money field)',
            'radius.integer' => 'Use only numbers to set radius',
            'radius.min' => 'not less than 1 km for radius',
            'radius.max' => 'It\'s too much, even Moskow has diameter less than 22 km',
            'city.in' => 'nice try bro ;) but you must use only this select for city. Tnx!',
            'gender.required' => 'you must choose who you are looking for: male or female',
            'gender.in' => 'nice try bro ;) but you must use only this select for gender. Tnx!',
            'min_height.integer' => 'Use only numbers for min height',
            'min_height.lte' => 'min height can\'t be more than max height',
            'min_height.min' => 'not less than 130 sm for min height',
            'min_height.max' => 'I think it\'s to high. Any way there are no such high users here (for min height field)',
            'max_height.integer' => 'Use only numbers for max height',
            'max_height.min' => 'not less than 130 sm for max height',
            'max_height.max' => 'I think it\'s to high. Any way there are no such high users here (for max height field)',
            'min_weight.integer' => 'Use only numbers for min weight',
            'min_weight.lte' => 'min weight can\'t be less than max weight',
            'min_weight.min' => 'not less 30 kg for min weight',
            'min_weight.max' => 'I think it\'s to much. Any way there are no such users here (for min weight field)',
            'max_weight.integer' => 'Use only numbers for max weight',
            'max_weight.min' => 'not less than 30 kg for max weight',
            'max_weight.max' => 'I think it\'s to much. Any way there are no such users here (for max weight field)',
            'online.required' => 'you must choose who you are looking for: online or you don\'t care',
            'online.boolean' => 'nice try bro ;) but you must use only this select for online parameter. Tnx!',
        ];
    }
}
