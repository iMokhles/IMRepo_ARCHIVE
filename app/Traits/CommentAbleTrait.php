<?php

// Trait created using make:trait command 

namespace App\Traits;

use App\Models\Comments;

trait CommentAbleTrait
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comments::class, 'package');
    }

    /**
     * @return bool
     */
    public function getCanBeRated()
    {
        return (isset($this->canBeRated)) ? $this->canBeRated : false;
    }

    /**
     * @return bool
     */
    public function mustBeApproved()
    {
        return (isset($this->mustBeApproved)) ? $this->mustBeApproved : false;
    }

    /**
     * @return mixed
     */
    public function totalCommentCount()
    {
        return ($this->mustBeApproved()) ? $this->comments()->where('approved', true)->count() : $this->comments()->count();
    }

    /**
     * @return float
     */
    public function averageRate()
    {
        return ($this->getCanBeRated()) ? $this->comments()->where('approved', true)->avg('rate') : 0;
    }
}