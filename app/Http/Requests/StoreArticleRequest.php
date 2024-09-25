<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:50', 'unique:articles'],
            'text' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg']
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'Article Title',
            'text' => 'Article Text',
            'category' => 'Article Category',
            'tags' => 'Article Tag',
            'image' => 'Article Image',
        ];
    }
}
