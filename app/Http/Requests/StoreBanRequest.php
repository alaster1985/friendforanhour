<?php

namespace App\Http\Requests;

use App\Profile;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBanRequest extends FormRequest
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
            'profile_id' => [
                'required',
                Rule::in(Profile::pluck('id')->all()),
            ],
            'reason' => 'required|min:3|max:10000',
            'duration' => 'required|integer|min:1|max:1000',
            'reason_amnesty' => 'required_if:moderator_id_amnesty,' . Auth::id() . '|min:10|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'Пожалуйста, укажите причину бана',
            'reason.max' => 'Для поля "причина бана" максимальное количество символов ограничено - 10000',
            'reason.min' => 'Для поля "причина бана" минимальное количество символов ограничено - 3',
            'profile_id.required' => 'Что-то пошло не так с одним из параметров профайла. Пожалуйста перезагрузите страницу',
            'profile_id.in' => 'Вы уверены, что данный пользователь существует? Что-то пошло не так с одним из параметров профайла. Пожалуйста перезагрузите страницу',
            'duration.required' => 'Установите длительность бана, (час)',
            'duration.integer' => 'Используйте только цифры для поля длительности бана',
            'duration.min' => 'Минимальная длительность бана - 1 час',
            'duration.max' => 'Длительность бана установлена более чем на 6 ннедель. Используйте меньшее значение',
            'reason_amnesty.max' => 'Причина для "амнистии" бана очень большая, не более 10000 символов',
            'reason_amnesty.min' => 'Причина для "амнистии" бана описана очень коротко. Минимум 10 символов',
            'reason_amnesty.required_if' => 'Nice try BRO ;)',
        ];
    }
}
