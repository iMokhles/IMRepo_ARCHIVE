<?php

// Trait created using make:trait command 

namespace App\Traits;

use App\Models\Comments;

trait CanUseCommentsTrait
{

    /**
     * @param $commentable
     * @param string $commentText
     * @param int $rate
     * @return $this
     */
    public function comment($commentable, $commentText = '', $rate = 0)
    {
        $comment = new Comments([
            'user_id'        => $this->id,
            'commented_type' => get_class($this),
            'comment'        => $commentText,
            'rate'           => ($commentable->getCanBeRated()) ? $rate : null,
            'approved'       => ($commentable->mustBeApproved() && ! $this->isAdmin()) ? false : true,
            'package_id'     => $commentable->id,
            'commentable_type' => get_class($commentable),
        ]);
        $commentable->comments()->save($comment);
        return $this;
    }
    /**
     * @return bool
     */
    public function isAdmin()
    {
        return false;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'user');
    }
}