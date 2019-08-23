<?php

namespace App\Http\Requests;

use App\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends FormRequest
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
            'id' => 'required',
            'status_id' => Rule::in(TicketStatus::pluck('id')->all()),
            'report' => 'required|min:3|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'report.required' => 'Пожалуйста, заполните поле отчета (report)',
            'report.max' => 'Максимальная длина для поля отчета (report) превышена. Максмум 10000 символов.',
            'report.min' => 'Для поля отчёта (report) минимальное количество символов установлено в размере 3 символа',
            'id.required' => 'Что-то пошло не так с одним из обязательных полей. Пожалуйста, перезагрузите страницу',
            'status_id.in' => 'Что-то пошло не так с полем статуса. Пожалуйста, перезагрузите страницу',
        ];
    }

}
