<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            "id"            =>$this->id,
            "title"         => $this->title,
            "description"   => $this->description,
            "tasks"         => $this->tasks,
            "skills"        => $this->skills,
            "age"           => $this->age,
            "job_type"      => $this->job_type,
            'email'          =>$this->email,
            'nationality'    =>$this->nationality,
            'gender'         =>$this->gender,
            'image'          =>assets('photos/' . $this->image),
            // "section_id"   => $this->
        ];
    }
}
