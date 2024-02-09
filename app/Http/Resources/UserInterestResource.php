<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInterestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->user_id);
        $category = Category::find($this->category_id);
        return [
            'id'        => $this->id,
            'user'      => new UserResource($user),
            'category'  => new CategoryResource($category),
        ];
    }
}
