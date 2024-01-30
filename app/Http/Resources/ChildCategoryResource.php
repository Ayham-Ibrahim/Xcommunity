<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = Category::where('id',$this->category_id);
        return [
            "id"    => $this->id,
            'name' => $this->title,
            'category_id' => new CategoryResource($category),
        ];
    }
}
