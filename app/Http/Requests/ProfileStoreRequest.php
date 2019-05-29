<?php

namespace App\Http\Requests;

use App\City;
use App\Country;
use App\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileStoreRequest extends FormRequest
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
        if ($this->request->get('country') === 'new') {
            $countryId = false;
        } else {
            $countryId = $this->request->get('country');
        }
        $gendersIds = Gender::getAllGenders()->pluck('id')->all();
        $citiesIds = City::getAllCitiesByCountryId($countryId)->pluck('id')->all();
        $citiesIds['new'] = 'new';
        $countriesIds = Country::getAllCountries()->pluck('id')->all();
        $countriesIds['new'] = 'new';
        return [
            'nickname' => 'required|min:2|max:50',
            'first_name' => 'required|min:2|max:50',
            'second_name' => 'required|min:2|max:50',
            'bdate' => 'required|before_or_equal:18 years ago|after:123 years ago',
            'about' => 'nullable|min:5|max:10000',
            'gender' => [
                'required',
                Rule::in($gendersIds),
            ],
            'address' => 'nullable|min:5|max:100',
            'city' => [
                'required',
                Rule::in($citiesIds),
            ],
            'newCity' => 'nullable|required_if:city,new|min:2|max:100',
            'country' => [
                'required',
                Rule::in($countriesIds),
            ],
            'newCountry' => 'nullable|required_if:country,new|min:3|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'Please, enter your nickname',
            'nickname.min' => 'Your nickname must consist of more than 2 characters',
            'nickname.max' => 'Your nickname must consist of less than 50 characters',
            'bdate.required' => 'Please, enter your own birth of date',
            'bdate.before_or_equal' => 'Nice try BRO! ;) But you must be over 18 years old!',
            'bdate.after' => 'Seriously 0_o, you are really so old? - Don\'t make my scripts laugh',
            'about.min' => 'Tell me more about yourself. It\'s to short ))',
            'about.max' => 'Shorter please, max 10000 characters',
            'gender.required' => 'Please, set your gender',
            'gender.in' => 'Nice try BRO! :) But you must set your own gender only from this list',
            'address.min' => 'It is too short address',
            'address.max' => 'Shorter please, if you use a city name, you can remove it ;)',
            'city.required' => 'You need to set the city',
            'city.in' => 'You\'r good :) But set city from this select list. Tnx',
            'newCity.required_if' => 'Please, enter your city name',
            'newCity.min' => 'I know that there are cities with a name of one character, but it’s better to contact technical support about this',
            'newCity.max' => 'I know that there are cities with a name of more than 100 characters, but it’s better to contact technical support about this',
            'country.required' => 'You need to set the country',
            'country.in' => 'You\'r good :) But set country from this select list. Tnx',
            'newCountry.required_if' => 'Please, enter your country name',
            'newCountry.min' => 'I doubt that there are countries with so short name, but if it is true it’s better to contact technical support about this',
            'newCountry.max' => 'I know that there are countries with a name of more than 100 characters, but it’s better to contact technical support about this',

        ];
    }
}
