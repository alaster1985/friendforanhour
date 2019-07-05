<?php

namespace App\Http\Requests;

use App\Role;
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
        return [
            'name' => 'required|max:100|min:3',
            'email' => 'required|email|max:100|unique:users,email',
            'role' => [
                'required',
                Rule::in($rolesId),
            ],
            'password' => 'required_without:user_id|min:6|max:50',
            'co_password' => 'required_without:user_id|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please, set user name',
            'name.max' => 'Shorter please, max 100 characters',
            'name.min' => 'Very short name. At least 3 characters',
            'email.required' => 'Please, set your email',
            'email.regex' => 'Please, follow to the format email',
            'email.max' => 'Shorter please, max 100 characters',
            'email.unique' => 'Such email is already taken',
            'role.required' => 'Please, select the role for this user',
            'role.in' => 'Nice try BRO ;) But set role from this select',
            'password.required_without' => 'Please, set users password',
            'password.max' => 'Shorter please, max 50 characters',
            'password.min' => 'Very short password. At least 6 characters',
            'co_password.required_without' => 'Please, confirm the password',
            'co_password.same' => 'Password does not match the value entered',
        ];
    }
}
