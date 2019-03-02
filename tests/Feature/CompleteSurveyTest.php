<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteSurveyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testViewSurvey()
    {
        // Lets setup a survey
        $survey = $this->createSurveysForUser(1)
            ->first();

        $response = $this->get(route('complete-survey.view', $survey->id))
            ->assertSuccessful()
            ->assertViewIs('complete-survey.view')
            ->assertViewHas('survey', $survey);

        // Then we want to be sure all our questions are displayed to the user
        $survey->questions->each(function ($q) use ($response) {
            $response->assertSee($q->question);
        });
    }

    public function testCompleteAndSubmitSurvey()
    {

    }
}
