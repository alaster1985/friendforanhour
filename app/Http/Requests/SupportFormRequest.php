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
            'title.required' => 'Please, set the title',
            'title.max' => 'Shorter please, max 100 characters',
            'title.min' => 'Very short title. At least 3 characters',
            'email.required_without' => 'Please, set your email',
            'email.regex' => 'Please, follow to the format email',
            'email.max' => 'Shorter please, max 100 characters',
            'name_from.required_without' => 'Please, enter your name',
            'name_from.min' => 'Very short name. At least 3 characters',
            'name_from.max' => 'Shorter please, max 100 characters',
            'description.required' => 'Please, describe your matter',
            'description.max' => 'Shorter please, max 10000 characters',
            'description.min' => 'Very short description. At least 3 characters',
            'profile_id.required_without' => 'Nice try BRO ;) But don\'t touch anything',
            'profile_id.in' => 'Nice try BRO ;) But don\'t touch anything. And use only your account, please! Tnx!',
        ];
    }
}
