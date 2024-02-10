<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Traits\GetSavedItemTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    use GetSavedItemTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $item = $this->getNotifiedItem($this->item_id,$this->item_type);
        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'body'   => $this->body,
            'item'   => $item,
        ];
    }
}
