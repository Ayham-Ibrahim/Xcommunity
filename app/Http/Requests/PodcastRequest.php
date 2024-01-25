<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PodcastRequest extends FormRequest
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
            "title"             =>'required|string|max:100',
            "voice"             =>'required|audio|mimes:mpeg,mpga,mp3,wav',
            "duration"          =>'required|string',
            "text_file"         =>'required|mimes:doc,docx',
            "podcast_list_id"   =>'required|exists:podcast_lists,id',
            "child_category_id" =>'required|exists:child_categories,id',
            "section_id"        =>'required|exists:sections,id',
        ];
    }
}
