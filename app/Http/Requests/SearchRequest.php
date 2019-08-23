<?php

namespace App\Http\Requests;

use App\City;
use App\Gender;
use App\ServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

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
            'min_age.integer' => 'Используйте только цифры для поля минимального возраста',
            'min_age.lte' => 'Минимальный возраст не может быть больше максимального',
            'min_age.min' => 'Возраст друга не может быть меньше 18 лет',
            'min_age.max' => 'Думаю, с возрастом Для Вас всё же перебор. Даже если я ошибаюсь, тут таких пользователей нет (for min age field)',
            'max_age.integer' => 'Используйте только цифры для поля максимального возраста',
            'max_age.min' => 'Возраст друга не может быть меньше 18 лет',
            'max_age.max' => 'Думаю, с возрастом Для Вас всё же перебор. Даже если я ошибаюсь, тут таких пользователей нет (for max age field)',
//            'longitude.required' => 'you must set your geo chords (longitude)',
            'longitude.numeric' => 'что-то пошло не так с параметром долгота (longitude) - должно быть число',
            'longitude.min' => 'минимально допустимая долгота -180 градусов',
            'longitude.max' => 'максимально допустимая долгота 180 градусов',
//            'latitude.required' => 'you must set your geo chords (latitude)',
            'latitude.numeric' => 'что-то пошло не так с параметром широта (latitude) - должно быть число',
            'latitude.min' => 'минимально допустимая шитора -90 градусов',
            'latitude.max' => 'максимально допустимая шитора 90 градусов',
            'friend_type.required' => 'Необходимо сделать правильный выбор. Кого Вы ищите: друга или спонсора?',
            'friend_type.in' => 'nice try bro ;) but you must use only this select for type of "friend". Tnx!',
            'min_money.integer' => 'Используйте только цифры для параметра минимальной цены',
            'min_money.lte' => 'минимальная цена не может быть больше максимальной',
            'min_money.min' => 'минимальная цена не может быть отрицательным числом',
            'min_money.max' => 'Думаю, это слишком много. В любом случае услуг с такой стоимостью на ресурсе нет (for min money field)',
            'max_money.integer' => 'Используйте только цифры для параметра максимальной цены',
            'max_money.min' => 'Максимальная цена не может быть отрицательным числом',
            'max_money.max' => 'Думаю, это слишком много. В любом случае услуг с такой стоимостью на ресурсе нет (for max money field)',
            'radius.integer' => 'Пожалуйста, используйте только цифры для определения радиуса, (км)',
            'radius.min' => 'Пожалуйста, установите радиус не менее чем 1, (км)',
            'radius.max' => 'Это слишком большой радиус, даже для Москвы',
            'city.in' => 'nice try bro ;) but you must use only this select for city. Tnx!',
            'gender.required' => 'Пожалуйста, сделайте выбор. Вы ищите мужчину или женщину',
            'gender.in' => 'nice try bro ;) but you must use only this select for gender. Tnx!',
            'min_height.integer' => 'Используйте только цифры для параметра минимального роста',
            'min_height.lte' => 'Минимальный рост не может быть больше максимального',
            'min_height.min' => 'Минимально допустимое значение для минимального роста не может быть меньше 130, (см)',
            'min_height.max' => 'Очень большой рост, таких пользователей тут нет (for min height field)',
            'max_height.integer' => 'Используйте только цифры для параметра максимального роста',
            'max_height.min' => 'Максимальный рост не может быть меньше 130, (см). По крайней мете на этом ресурсе таких пользователей нет',
            'max_height.max' => 'Очень большой рост, таких пользователей тут нет (for max height field)',
            'min_weight.integer' => 'Используйте только цифры для параметра минимального веса',
            'min_weight.lte' => 'Минимальный вес не может быть больше максимального',
            'min_weight.min' => 'Установите минимальный вес не менее чем в 30б (кг)',
            'min_weight.max' => 'Слишком большое значение для минимального веса. Таких пользователей тут нет (for min weight field)',
            'max_weight.integer' => 'Используйте только цифры для параметра максимального веса',
            'max_weight.min' => 'Минимально допустимое значение для веса не может быть меньше 30, (кг)',
            'max_weight.max' => 'Слишком большое значение для максимального веса. Таких пользователей тут ет (for max weight field)',
            'online.required' => 'Сделайте свой выбор: вы ищите тех, кто онлайн, или же вам не важно?',
            'online.boolean' => 'nice try bro ;) but you must use only this select for online parameter. Tnx!',
        ];
    }
}
