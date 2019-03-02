<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Repositories\SurveyRepository;
use App\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSurveyRequest $request
     * @return SurveyResource
     * @throws \Throwable
     */
    public function store(CreateSurveyRequest $request)
    {
        $data = $request->validated();

        $survey = SurveyRepository::create($data, $request->user());

        return new SurveyResource($survey);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
