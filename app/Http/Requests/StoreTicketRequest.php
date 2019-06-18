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
            'report.required' => 'Please, report this',
            'report.max' => 'Shorter please, max 10000 characters',
            'report.min' => 'Very short report. At least 3 characters',
            'id.required' => 'Something went wrong with ID field. Please reload page',
            'status_id.in' => 'Something went wrong with Status field. Please reload page',
        ];
    }

}
