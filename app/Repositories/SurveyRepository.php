<?php
/**
 * Survey repository
 */

namespace App\Repositories;


use App\User;

class SurveyRepository
{
    public static function forUser(User $user) {
        return $user->surveys;
    }
}
