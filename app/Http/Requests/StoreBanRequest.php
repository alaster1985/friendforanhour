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
            'reason.required' => 'Please, describe the reason for bun',
            'reason.max' => 'Shorter please, max 10000 characters',
            'reason.min' => 'Very short reason. At least 3 characters',
            'profile_id.required' => 'Something went wrong with profile ID field. Please reload page',
            'profile_id.in' => 'Are you sure that this profile exist, Something went wrong with profile ID field. Please reload page',
            'duration.required' => 'You must set duration for ban time (hours)',
            'duration.integer' => 'You must use only numbers',
            'duration.min' => 'At least 1 hour for ban time',
            'duration.max' => 'It is more than 41 days. It is too long...',
            'reason_amnesty.max' => 'Shorter please, max 10000 characters',
            'reason_amnesty.min' => 'Very short reason for amnesty. At least 10 characters',
            'reason_amnesty.required_if' => 'Nice try BRO ;)',
        ];
    }
}
