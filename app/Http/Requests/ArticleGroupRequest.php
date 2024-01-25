<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleGroupRequest extends FormRequest
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
            'name'              => 'required|string|max:55',
            'group_ingo'        => 'required|string|max:550',
            'image'             => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'child_category_id' => 'required|integer|exists:child_categories,id'
        ];
    }
}
