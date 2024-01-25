<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserInfoRequest extends FormRequest
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
            'photo'              => 'nullable|image|mimes:png,jpg,jpeg,gif,sug|max:2048',
            'phone_number'       => 'nullable|string',
            'phone_number_priv'  => ["nullable",Rule::in(['public','me'])],
            'facebook'           => 'nullable|string',
            'facebook_priv'      => ["nullable",Rule::in(['public','me'])],
            'linkedin'           => 'nullable|string',
            'linkedin_priv'      => ["nullable",Rule::in(['public','me'])],
            'email_priv'         => ["nullable",Rule::in(['public','me'])],
            'gender'             => ["nullable",Rule::in(['male','female','no profrence'])],
            'birth_date'         => 'nullable|date',
            'birth_date_priv'    => ["nullable",Rule::in(['public','me'])],
            'job'                => 'nullable|string',
            'job_priv'           => ["nullable",Rule::in(['public','me'])],
            'education'          => 'nullable|string',
            'education_priv'     => ["nullable",Rule::in(['public','me'])],
            'location'           => 'nullable|string',
            'location_priv'      => ["nullable",Rule::in(['public','me'])],
        ];
    }
}
