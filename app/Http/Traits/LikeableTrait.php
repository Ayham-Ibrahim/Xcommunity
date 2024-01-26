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
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    private function addLike(User $user)
    {
        $user->likes()->create([
            'likeable_id' => $this->id,
            'likeable_type' => get_class($this),
            'reaction' => 'like',
        ]);
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
