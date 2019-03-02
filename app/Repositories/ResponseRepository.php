<?php
/**
 * Created by PhpStorm.
 * User: ProductMgr_170
 * Date: 3/2/2019
 * Time: 9:45 AM
 */

namespace App\Repositories;


use App\Response;

class ResponseRepository
{

    /**
     * Save responses for a survey
     * @param array $data
     * @return array
     * @throws \Throwable
     */
    public static function saveFormData(array $data)
    {
        $responses = [];

        foreach ($data['answers'] as $questionId => $answer) {
            $response = new Response([
                'session_id' => $data['session_id'],
                'question_id' => $questionId,
                'answer' => $answer
            ]);

            $response->saveOrFail();

            array_push($responses, $response);
        }

        return $responses;
    }
}
