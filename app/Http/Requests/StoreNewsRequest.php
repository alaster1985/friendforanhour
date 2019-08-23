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
            'title.required' => 'Пожалуйста, установите заголовок (title)',
            'title.max' => 'Для заголовка (title) используйте не более 100 символов',
            'title.min' => 'Очень короткий заголовок (title). Необходимо больше символов (3)',
            'photo.image' => 'Загружаемый файл не является изображением (img)',
            'photo.mime' => 'Загружаемый файл не является изображением (mime)',
            'content.required' => 'Пожалуйста заполните текст новости',
            'content.min' => 'Очень короткий текст для новости',
            'content.max' => 'Текст новости слишком длинный, не более 10000 символов',
            'disabled.boolean' => 'Just set disabled field from select. Tnx',
        ];
    }
}
