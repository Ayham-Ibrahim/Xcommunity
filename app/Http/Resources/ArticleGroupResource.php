<?php

namespace App\Http\Resources;

use App\Http\Traits\VisitorableTrait;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleGroupResource extends JsonResource
{
    use VisitorableTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category_child = $this->childCategory;
        $category = $category_child->category;
        $articles = $this->articles;
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'group_info'       => $this->group_info,
            'image'            => asset('images/' . $this->image),
            'category'         => $category->name,
            'articles_count'   => $articles->count(),
            'visitors_count'   => $this->visitorCount(),
            'followers_count'  => $this->followersCount(),
        ];
    }
}
