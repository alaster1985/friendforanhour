<?php

namespace App\Http\Requests;

use App\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Add1MOAccessRequest extends FormRequest
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
        $trnId = trim(substr(url()->previous(), strpos(url()->previous(), "=") + 1));
        $prfId = Transaction::find($trnId)->profile_id;
        if (!Hash::check($this->request->get('password'), Auth::user()->password)){
            return [
                'wrong_password' => 'required',
            ];
        }
        $rule = [
            'profile_id' => 'required|in:'.$prfId,
            'login' => 'required|in:'.Auth::user()->email,
            'password' => 'required',
            'reason' => 'required|min:10|max:10000',
        ];
        return $rule;
    }

    public function messages()
    {
//        if (!Hash::check($this->request->get('password'), Auth::user()->password)){
//            return [
//                'wrong_password.required' => 'password was not confirmed',
//            ];
//        }
        $messages = [
            'profile_id.required' => 'You have now profile_id. Please reload page and try again',
            'profile_id.in' => 'Something wrong with profile_id field. Please reload page and try again',
            'password.required' => 'Please enter your password',
            'login.required' => 'Please enter your login (email)',
            'login.in' => 'This is not your login (email).',
            'wrong_password.required' => 'password was not confirmed',
            'reason.required' => 'Please, describe the reason for add 1/MO access',
            'reason.max' => 'Shorter please, max 10000 characters',
            'reason.min' => 'Very short reason. At least 3 characters',
        ];
        return $messages;
    }
}
