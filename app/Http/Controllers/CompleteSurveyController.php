<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class CompleteSurveyController extends Controller
{
    /**
     * Complete a survey
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Survey $survey)
    {
        return view('complete-survey.view', compact('survey'));
    }

    public function submit() {

    }
}
