<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'tasks'          =>'required|min:3|max:1000',
            'skills'         =>'required|min:3|max:1000',
            'age'            =>'required|string|max:200',
            'job_type'       =>'required|string|max:200',
            'email'          =>'required|string|max:200',
            'nationality'    =>'required|string|max:200',
            'gender'         =>['required',
                                    Rule::in(['male','female']),
                                ],
            'image'          => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'section_id'     =>'required|exists:sections,id',

        ];
    }
}
