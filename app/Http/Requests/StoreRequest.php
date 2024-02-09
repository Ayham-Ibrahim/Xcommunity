<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title'        => 'required|string|max:225',
            'discription'  => 'required|string',
            'image'        => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'file'         => 'nullable|mimes:pdf,doc,docx|max:2048',
            'type'         => [
                'required',
                Rule::in(['Book', 'Supplement']),
            ],
            'category_id'  => 'required|integer|exists:categories,id'
        ];
    }
}
