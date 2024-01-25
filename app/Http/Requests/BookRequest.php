<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'          =>'required|string|max:200',
            'description'    =>'required|min:3|max:1000',
            'image'          => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'file'           =>'required|mimes:doc,docx,pdf',
            'category_id'    =>'required|exists:categories,id',
            'section_id'     =>'required|exists:sections,id',
        ];
    }
}
