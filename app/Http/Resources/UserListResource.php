<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::where('id',$this->user_id)->first();
        return [
            'id'    => $this->id,
            'name' => $this->name,
            'user_id' => new UserResource($user),
        ];
    }
}
