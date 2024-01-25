<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title'             => 'required|string|max:225',
            'body'              => 'required|string',
            'image'             => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'time_to_read'      => 'required|string',
            'article_group_id'  => 'required|integer|exists:article_groups,id',
        ];
    }
}
