<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SupportFormRequest extends FormRequest
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
        Auth::check() ? $id = Auth::user()->profile_id : $id = null;
        return [
            'title' => 'required|max:100|min:3',
            'email' => 'required_without:profile_id|email|max:100',
            'name_from' => 'required_without:profile_id|min:2|max:100',
            'description' => 'required|min:3|max:10000',
            'profile_id' => [
                'required_without:email',
                Rule::in([$id])
            ]
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Пожалуйста, укажите заголовок обращения (title)',
            'title.max' => 'Максимальная длина для заголовка 100 символов',
            'title.min' => 'Очень короткий заголовок. Пожалуйста, убедитесь в том, что длина составляет не менее 3 символа',
            'email.required_without' => 'Пожалуйста, заполните поле адреса электронной почты (email)',
            'email.regex' => 'Поле email не соответствет формату адреса электронной почты.',
            'email.max' => 'Слишком "длинный" адрес электронной почты, максимум 100 символов.',
            'name_from.required_without' => 'Пожалуйста, укажите свое имя',
            'name_from.min' => 'Очеь короткое имя, минимум 2 символа',
            'name_from.max' => 'Очень длинное имя, максимум 100 символов',
            'description.required' => 'Пожалуйста, опишите причину обращения',
            'description.max' => 'Пожалуйста, сократите причину обращения, максимум 10000 символов',
            'description.min' => 'Очень короткая причина обращения, расскажите нам чуть более подробно',
            'profile_id.required_without' => 'Nice try BRO ;) But don\'t touch anything',
            'profile_id.in' => 'Nice try BRO ;) But don\'t touch anything. And use only your account, please! Tnx!',
        ];
    }
}
