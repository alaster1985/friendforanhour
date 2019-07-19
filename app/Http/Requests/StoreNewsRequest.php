<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:3|max:10000',
            'photo' => 'nullable|image|mimes:jpeg,bmp,png',
            'disabled' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please, set title',
            'title.max' => 'Shorter please, max 100 characters',
            'title.min' => 'Very short title. At least 3 characters',
            'photo.image' => 'It was not an image',
            'photo.mime' => 'Nice try! But It was not an image',
            'content.required' => 'Please, set news description',
            'content.min' => 'Very short news description',
            'content.max' => 'Shorter please, max 10000 characters (news description)',
            'disabled.boolean' => 'Just set disabled field from select. Tnx',
        ];
    }
}
