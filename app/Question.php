<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed id
 */
class Question extends Model
{
    // Question type constants
    const FREE_TEXT = 'free_text';
    const NUMBERS = 'numbers';
    const SINGLE_ANSWER = 'single_answer';
    const MULTIPLE_ANSWER = 'multiple_answer';

    protected $fillable = ['question', 'type', 'options'];

    protected $casts = [
        'options' => 'array'
    ];

    /**
     * Get the survey this question belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }


    /**
     * Get all responses for this question
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * Get answer stats for this question
     * @return \Illuminate\Support\Collection
     */
    public function getResponseStatsAttribute()
    {
        return DB::table('responses')
            ->selectRaw('answer, count(answer) as answer_count')
            ->where('question_id', $this->id)
            ->groupBy('answer')
            ->get();
    }
}
