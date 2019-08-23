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
            'servicesValidate.required' => 'Что-то пошло не так во время сохранения услуг. Пожалуйста, обновите страницу и попробуйте еще раз. Если Вы видите это сообщение снова - попробуйте добавить и сохранить услуги по одной.',
            'nickname.required' => 'Пожалуйста, укажите свой nickname',
            'nickname.min' => 'nickname не может содержать менее двух символов',
            'nickname.max' => 'nickname не может содержать более 50 символов',
            'bdate.required' => 'Пожалуйста, укажите свою дату рождения',
            'bdate.before_or_equal' => 'Nice try BRO! ;) But you must be over 18 years old!',
            'bdate.after' => 'Seriously 0_o, you are really so old? - Don\'t make my scripts laugh',
            'about.min' => 'Расскажи немного больше о себе, этого не достаточно ))',
            'about.max' => 'Слишком много рассказали о себе, пожалуйста не более 10000 символов',
            'gender.required' => 'Выбирете свой пол',
            'gender.in' => 'Nice try BRO! :) But you must set your own gender only from this list',
            'address.min' => 'Слишком короткий адрес',
            'address.max' => 'Пожалуйста, сократите адрес до 100 символов. Спасибо.',
            'city.required' => 'Пожалуйста, выберите свой город',
            'city.in' => 'You\'r good :) But set city from this select list. Tnx',
            'newCity.required_if' => 'Введите название своего города',
            'newCity.min' => 'Я знаю, что есть названия городов с одним символом, не думаю, что это именно этот случай.',
            'newCity.max' => 'Я знаю, что есть города с очень длинным названием, не думаю, что это именно этот случай.',
            'country.required' => 'Пожалуйста, выберите свою страну',
            'country.in' => 'You\'r good :) But set country from this select list. Tnx',
            'newCountry.required_if' => 'Введите название страны',
            'newCountry.min' => 'Для названия страны слишком мало символов',
            'newCountry.max' => 'Для названия страны слишком много символов',
//            'height.required' => 'Height must set the height',
            'height.integer' => 'Используйте только цифры чтоб указать свой рост',
            'height.min' => 'Очень мало для параметра роста',
            'height.max' => 'Очень много для параметра роста',
//            'weight.required' => 'Weight must set the height',
            'weight.integer' => 'Используйте только цифры чтоб указать свой вес',
            'weight.min' => 'Очень мало для параметра веса',
            'weight.max' => 'Очень много для параметра веса',

        ];

        foreach ($this->request->get('service_name') ?? [] as $key => $value) {
            $messages['service_name.' . $key . '.required'] = 'Необходимо установить название услуги';
            $messages['service_name.' . $key . '.min'] = 'Название услуги оказалось слишком коротким. Минимум 5 символов';
            $messages['service_name.' . $key . '.max'] = 'Название услуги получилось не таким уж и коротким. Максимум 14 символов';
        }
        foreach ($this->request->get('service_description') ?? [] as $key => $value) {
            $messages['service_description.' . $key . '.required'] = 'Пожалуйста, опишите услугу более подробно';
            $messages['service_description.' . $key . '.min'] = 'Поле с описанием услуги должно содержать более 5 символов';
            $messages['service_description.' . $key . '.max'] = 'Пожалуйста, не превышайте 100 символов для описания услуги';
        }
        foreach ($this->request->get('price') ?? [] as $key => $value) {
            $messages['price.' . $key . '.integer'] = 'Используйте только цифры для поля стоимости';
            $messages['price.' . $key . '.min'] = 'мы не можем установить отрицательное значение для поля цены';
            $messages['price.' . $key . '.max'] = 'Я вижу Вы знаете толк в хороших услугах, и всё же, попробуйте ограничиться числом в 100000';
        }
        foreach ($this->request->get('is_disabled') ?? [] as $key => $value) {
            $messages['is_disabled.' . $key . '.required'] = 'Пожалуйста, сделайте свой выбор: показать или скрыть услугу';
            $messages['is_disabled.' . $key . '.boolean'] = 'You\'r good BRO! But use only this select. Tnx!';
        }

        return $messages;
    }
}
