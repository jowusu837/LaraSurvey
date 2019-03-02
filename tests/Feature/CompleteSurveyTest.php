<?php

namespace Tests\Feature;

use App\Survey;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteSurveyTest extends TestCase
{
    use WithFaker;
    /**
     * Test survey
     * @var Survey
     */
    private $survey;

    protected function setUp(): void
    {
        parent::setUp();

        // Lets setup a survey
        $this->survey = $this->createSurveysForUser(1)
            ->first();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testViewSurvey()
    {
        $response = $this->get(route('complete-survey.view', $this->survey->id))
            ->assertSuccessful()
            ->assertViewIs('complete-survey.view')
            ->assertViewHas('survey', $this->survey);

        // Then we want to be sure all our questions are displayed to the user
        $this->survey->questions->each(function ($q) use ($response) {
            $response->assertSee($q->question);
        });
    }

    /**
     * We want to test that after completing a survey, we should be sent to a 'done' page.
     * Since a survey form has no validation, we are not validating inputs
     * @return void
     */
    public function testCompleteAndSubmitSurvey()
    {
        $this->submitCompletedSurvey($this->faker->uuid)
            ->assertRedirect(route('complete-survey.done'));;
    }


    /**
     * If a user has already completed a survey, he or show must not be allowed to complete the same survey twice.
     * @return void
     */
    public function testUserCannotFillSameSurveyTwice()
    {
        // Our check is done simply using session ids so we must simulate two requests with same session id.
        $sessionId = $this->faker->uuid;

        // First attempt
        $this->submitCompletedSurvey($sessionId)
            ->assertRedirect(route('complete-survey.done'));;

        // Second attempt should fail
        $this->submitCompletedSurvey($sessionId)
            ->assertNotFound();
    }

    /**
     * This helper method just completes and submits a survey for us
     * @param string $sessionId
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function submitCompletedSurvey($sessionId): \Illuminate\Foundation\Testing\TestResponse
    {
        // this will hold our answers
        $answers = [];

        // Compile answers to questions
        $this->survey->questions
            ->each(function ($q) use ($answers) {
                $answers[$q->id] = $this->faker->text;
            });

        $response = $this->post(route('complete-survey.submit', $this->survey->id), [
            'answers' => $answers,
            'session_id' => $sessionId,
        ]);

        return $response;
    }
}
