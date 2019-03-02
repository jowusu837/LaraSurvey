<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int user_id
 * @property mixed id
 * @property Collection responses
 * @property Collection questions
 */
class Survey extends Model
{
    protected $fillable = ['title'];

    /**
     * Get questions for this survey
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get all responses for this survey
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function responses()
    {
        return $this->hasManyThrough(Response::class, Question::class);
    }

    /**
     * Get unique responses based on session id
     * @return Collection|\Illuminate\Support\Collection
     */
    public function getUniqueResponsesAttribute() {
        return $this->responses->unique('session_id');
    }
}
