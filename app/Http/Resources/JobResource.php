<?php

namespace App\Http\Resources;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $section = Section::find($this->section_id);

        return [
            "id"            =>$this->id,
            "title"         => $this->title,
            "discription"   => $this->discription,
            "tasks"         => $this->tasks,
            "skills"        => $this->skills,
            "age"           => $this->age,
            "job_type"      => $this->job_type,
            'email'          =>$this->email,
            'nationality'    =>$this->nationality,
            'gender'         =>$this->gender,
            'image'          =>Storage::url($this->image),
            'section'        => $section->name,
        ];
    }
}
