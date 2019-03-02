<?php

namespace App\Http\Controllers;

use App\Repositories\ResponseRepository;
use App\Survey;
use Illuminate\Http\Request;

class CompleteSurveyController extends Controller
{
    const COMPLETED_SURVEY_SESSION_KEY = 'completed_survey';

    /**
     * Complete a survey
     * @param Request $request
     * @param Survey $survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request, Survey $survey)
    {
        $session_id = $request->session()->getId();
        return view('complete-survey.view', compact('survey', 'session_id'));
    }

    /**
     * Submit feedback for a survey
     * @param Request $request
     * @param Survey $survey
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function submit(Request $request, Survey $survey)
    {
        if($request->session()->get(static::COMPLETED_SURVEY_SESSION_KEY) != $survey->id) {
            ResponseRepository::saveFormData($request->all());

            // This will ensure the same survey isn't filled twice.
            $request->session()->put(static::COMPLETED_SURVEY_SESSION_KEY, $survey->id);

            return redirect(route('complete-survey.done'));
        }

        abort(404, 'You have already completed this survey!');
    }

    public function done()
    {
        return view('complete-survey.done');
    }
}
