<?php

namespace App\Http\Controllers;

use App\Repositories\ResponseRepository;
use App\Survey;
use Illuminate\Http\Request;

class CompleteSurveyController extends Controller
{
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function submit(Request $request)
    {
        ResponseRepository::saveFormData($request->all());
        return redirect(route('complete-survey.done'));
    }

    public function done()
    {
        return view('complete-survey.done');
    }
}
