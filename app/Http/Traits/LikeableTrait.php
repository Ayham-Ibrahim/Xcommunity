<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

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
            $message = $this->title .' '. $this->section->name .' like removed successfully';
        } else {

            DB::beginTransaction();
            try {
                $this->addLike($user);

            if ($this->section->name == 'Store' ){
                activity()->causedBy($user)->log('You liked the '. $this->type .' about ' . $this->title);
            }
            activity()->causedBy($user)->log('You liked the '. $this->section .' about ' . $this->title);

            DB::commit();
            $message = $this->title .' '. $this->section->name .' liked successfully';
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }


        }

        return response()->json(['message' => $message]);
    }

    public function isLikedByUser(User $user): bool
    {
        return $this->likes()->where('user_id', $user->id)
                    ->where('likeable_id',$this->id)
                    ->where('likeable_type',get_class($this))
                    ->exists();
    }

    private function addLike(User $user)
    {
        $existingLike = $this->likes()->where([
            'user_id'      => $user->id,
            'likeable_id'   => $this->id,
            'likeable_type' => get_class($this),
        ])->first();

        if (!$existingLike) {
            $user->likes()->create([
                'likeable_id' => $this->id,
                'likeable_type' => get_class($this),
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
