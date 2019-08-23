<?php

namespace App\Http\Requests;

use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserStoreRequest extends FormRequest
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
        $rolesId = Role::getNotAdminAndNotUserRoles()->pluck('id')->all();
        $rules = [
            'name' => 'required|max:100|min:3',
            'role' => [
                'required',
                Rule::in($rolesId),
            ],
            'password' => 'required_without:user_id|min:6|max:50',
            'co_password' => 'required_without:user_id|same:password',
        ];
        if ($this->request->get('user_id')) {
            $emails = User::where('email', '<>',  User::find($this->request->get('user_id'))->email)->pluck('email')->all();
//            if (($key = array_search(User::find($this->request->get('user_id'))->email, $emails)) !== false) {
//                unset($emails[$key]);
//            }
//            $emails = array_diff( $emails, [User::find($this->request->get('user_id'))->email]);
//            dd($emails);
//            $rules['email'] = 'required|email|max:100|notIn:'.$emails;
            $rules['email'] = [
                'required',
                'email',
                'max:100',
                Rule::notIn($emails),
            ];
        } else {
            $rules['email'] = 'required|email|max:100|unique:users,email';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста, заполните поле user name.',
            'name.max' => 'Немного короче, максимум 100 символов.',
            'name.min' => 'Очень короткое имя, минимум 3 символа.',
            'email.required' => 'Пожалуйста, заполните поле email, укажите электронный адрес нового пользователя.',
            'email.regex' => 'Поле email не соответствет формату адреса электронной почты.',
            'email.max' => 'Слишком "длинный" адрес электронной почты, максимум 100 символов.',
            'email.unique' => 'Данный email уже существует в системе и не является уникальным.',
            'email.not_in' => 'Данный email уже существует в системе и не является уникальным.',
            'role.required' => 'Пожалуйста определите "роль" для пользователя.',
            'role.in' => 'Nice try BRO ;) И всё же, установи "роль" из выпадающего списка.',
            'password.required_without' => 'Определите пароль для пользователя.',
            'password.max' => 'Пароль должен быть не длинее 50 символов.',
            'password.min' => 'Для пароля минимум 6 символов.',
            'co_password.required_without' => 'Пожалуйста, подтвердите пароль.',
            'co_password.same' => 'Введенные пароли не соответствуют друг другу.',
        ];
    }
}
