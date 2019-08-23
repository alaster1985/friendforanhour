<?php

namespace App\Http\Requests;

use App\ArticleCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticlesRequest extends FormRequest
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
            'category_id' => [
                'required',
                Rule::in(ArticleCategory::pluck('id')->all()),
            ],
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
            'content.required' => 'Пожалуйста заполните текст статьи',
            'content.min' => 'Очень короткий текст для статьи',
            'content.max' => 'Текст статьи слишком длинный, не более 10000 символов',
            'disabled.boolean' => 'Just set disabled field from select. Tnx',
            'category_id.required' => 'Пожалуйста, выберите категорию для статьи',
            'category_id.in' => 'Just set category from this select. Tnx',
        ];
    }
}
