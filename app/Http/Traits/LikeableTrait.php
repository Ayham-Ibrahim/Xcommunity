<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait LikeableTrait
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function toggleLike(User $user)
    {
        if ($this->isLikedByUser($user)) {
            $this->removeLike($user);
            $message = get_class($this) . ' like removed successfully';
        } else {
            $this->addLike($user);
            $message = get_class($this) . ' liked successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function isLikedByUser(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)
                    ->where('likable_id',$this->id)
                    ->where('likable_type',get_class($this))
                    ->exists();
    }

    private function addLike(User $user)
    {
        $existingLike = $this->likes()->where([
            'user_id'      => $user->id,
            'likable_id'   => $this->id,
            'likable_type' => get_class($this),
        ])->first();

        if (!$existingLike) {
            $user->likes()->create([
                'likable_id' => $this->id,
                'likable_type' => get_class($this),
            ]);
        }

    }

    private function removeLike(User $user)
    {
        $this->likes()->where([
            'user_id' => $user->id,
            'likeable_id' => $this->id,
            'likeable_type' => get_class($this),
        ])->delete();
    }

    public function likesCount(): int
    {
        return $this->likes->count();
    }
}
