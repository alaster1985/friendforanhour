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
            'profile_id.required' => 'Отсутствует обязательное поле профайла. Пожалуйста, перезагрузите страницу и повторите снова.',
            'profile_id.in' => 'Что-то пошло не так с одним из обязательных параметров профайла. Пожалуйста, перезагрузите страницу и повторите снова.',
            'password.required' => 'Пожалуйста, введите свой пароль доступа к админке',
            'login.required' => 'Пожалуйста, введите Ваш логин (email)',
            'login.in' => 'Это не Ваш логин (email).',
            'wrong_password.required' => 'Пароль не подтвержден.',
            'reason.required' => 'Пожалуйста, опишите причину добавления одного месяца доступа.',
            'reason.max' => 'Пожалуйста, немного короче. Максимум 10000 символов.',
            'reason.min' => 'Очень мало текста для причины добавления. Не менее 10 символов.',
        ];
        return $messages;
    }
}
