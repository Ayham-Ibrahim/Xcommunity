<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait VisitorableTrait
{
    public function visitor(): MorphMany
    {
        return $this->morphMany(Visitor::class, 'visitorable');
    }

    public function visit(User $user)
    {
        if (!($this->isVisitor($user))) {
            $this->addVisitor($user);
        }
    }

    public function isVisitor(User $user): bool
    {
        return $this->visitor()->where('user_id', $user->id)
            ->where('visitorable_id', $this->id)
            ->where('visitorable_type', get_class($this))
            ->exists();
    }

    private function addVisitor(User $user)
    {
        $this->visitor()->create([
            'visitorable_id'   => $this->id,
            'visitorable_type' => get_class($this),
            'user_id'          => $user->id,
        ]);
    }


    public function visitorCount(): int
    {
        return $this->visitor->count();
    }
}
