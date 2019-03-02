<?php
/**
 * Survey repository
 */

namespace App\Repositories;


use App\Question;
use App\Survey;
use App\User;

class SurveyRepository
{
    public static function forUser(User $user)
    {
        return $user->surveys;
    }


    /**
     * Create a survey
     * @param array $data
     * @param User $user
     * @return Survey
     * @throws \Throwable
     */
    public static function create($data, $user)
    {
        // first create the survey...
        $survey = new Survey($data);
        $survey->user_id = $user->id;
        $survey->saveOrFail();

        // then add the questions
        if (isset($data['questions'])) {
            $questions = collect($data['questions']);

            $survey->questions()->saveMany($questions->map(function ($q) {
                return new Question(static::parseOptionsForQuestion($q));
            }));
        }

        return $survey;
    }

    /**
     * Converts options string into an array
     * @param array $q
     * @return array
     */
    private static function parseOptionsForQuestion($q)
    {
        $options = collect(preg_split('/\r\n|\n|\r/', $q['options']));

        $q['options'] =
            $options
                ->unique()
                ->toArray();

        return $q;
    }
}
