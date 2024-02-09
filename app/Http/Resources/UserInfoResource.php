<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->user;
        return [
            'id'                 => $this->id,
            'user'               => new UserResource($user),
            'email_priv'         => $this->email_priv,
            'phone_number'       => $this->phone_number,
            'phone_number_priv'  => $this->phone_number_priv,
            'facebook'           => $this->facebook,
            'facebook_priv'      => $this->facebook_priv,
            'linkedin'           => $this->linkedin,
            'linkedin_priv'      => $this->linkedin_priv,
            'gender'             => $this->gender,
            'birth_date'         => $this->birth_date,
            'birth_date_priv'    => $this->birth_date_priv,
            'job'                => $this->job,
            'job_priv'           => $this->job_priv,
            'education'          => $this->education,
            'education_priv'     => $this->education_priv,
            'location'           => $this->location,
            'location_priv'      => $this->location_priv,
            'photo'              => asset('images/' . $this->photo),
        ];
    }
}
