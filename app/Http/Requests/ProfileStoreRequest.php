<?php

namespace App\Http\Requests;

use App\City;
use App\Country;
use App\Gender;
use App\ServiceList;
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
        $servicesCollection = [];
        $servicesCollection['service_name'] = $this->request->get('service_name') ?? [];
        $servicesCollection['service_description'] = $this->request->get('service_description') ?? [];
        $servicesCollection['price'] = $this->request->get('price') ?? [];
        $servicesCollection['is_disabled'] = $this->request->get('is_disabled') ?? [];
        $servicesCollection['main_service_marker'] = $this->request->get('main_service_marker') ?? [];

        if (!ServiceList::servicesValidate($servicesCollection)) {
            return ['servicesValidate' => 'required'];
        }

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

        $rules = [
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
//            'service_name' => 'required',
//            'service_description' => 'required',
//            'price' => 'required',
//            'is_disabled' => 'required',
            'height' => 'nullable|integer|min:130|max:220',
            'weight' => 'nullable|integer|min:30|max:280',
        ];

        foreach ($this->request->get('service_name') ?? [] as $key => $value) {
            $rules['service_name.' . $key] = 'required|min:5|max:14';
        }
        foreach ($this->request->get('service_description') ?? [] as $key => $value) {
            $rules['service_description.' . $key] = 'required|min:5|max:100';
        }
        foreach ($this->request->get('price') ?? [] as $key => $value) {
            $rules['price.' . $key] = 'nullable|integer|min:0|max:100000';
        }
        foreach ($this->request->get('is_disabled') ?? [] as $key => $value) {
            $rules['is_disabled.' . $key] = 'required|boolean';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'servicesValidate.required' => 'something went wrong. Please check your services',
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
//            'height.required' => 'Height must set the height',
            'height.integer' => 'Use only numbers to set the height',
            'height.min' => 'It\'s not enough',
            'height.max' => 'It\'s to many for this parameter',
//            'weight.required' => 'Weight must set the height',
            'weight.integer' => 'Use only numbers to set the height',
            'weight.min' => 'It\'s not enough',
            'weight.max' => 'It\'s to many for this parameter',

        ];

        foreach ($this->request->get('service_name') ?? [] as $key => $value) {
            $messages['service_name.' . $key . '.required'] = 'Please, set short service name';
            $messages['service_name.' . $key . '.min'] = 'It is too few characters for short service name. Min 5 characters';
            $messages['service_name.' . $key . '.max'] = 'Max 14 characters must be at short service name field';
        }
        foreach ($this->request->get('service_description') ?? [] as $key => $value) {
            $messages['service_description.' . $key . '.required'] = 'Please, set description for service';
            $messages['service_description.' . $key . '.min'] = 'It is too few characters for service description. Min 5 characters';
            $messages['service_description.' . $key . '.max'] = 'Shorter please. Max 100 characters for description field';
        }
        foreach ($this->request->get('price') ?? [] as $key => $value) {
            $messages['price.' . $key . '.integer'] = 'Please, use only numbers to set the prise';
            $messages['price.' . $key . '.min'] = 'You can\'t set price less than zero';
            $messages['price.' . $key . '.max'] = 'I see you know a lot about good services )) But max price must be less than 100000';
        }
        foreach ($this->request->get('is_disabled') ?? [] as $key => $value) {
            $messages['is_disabled.' . $key . '.required'] = 'Please, make your choice to hide or to show this service';
            $messages['is_disabled.' . $key . '.boolean'] = 'You\'r good BRO! But use only this select. Tnx!';
        }

        return $messages;
    }
}
