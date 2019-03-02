<?php

namespace Tests\Feature;

use App\Survey;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyTest extends TestCase
{
    /**
     * This test is supposed to guarantee that when we create surveys,
     * they get parsed through the controller to the view.
     *
     * @return void
     */
    public function testListing()
    {
        $surveys = $this->createSurveysForUser(5);

        $response = $this->actingAsUser()
            ->get(route('surveys.index'))
            ->assertSuccessful()
            ->assertViewIs('surveys.index')
            ->assertViewHas('surveys');

        // Since we are not paginating, let's ensure that we see all our surveys on the page
        foreach ($surveys as $survey) {
            $response->assertSee($survey->title);
        }
    }

    /**
     * We want to test that our view for creating a survey loads as expected.
     * Since the actual creation happens via API, we'll not cover that here.
     *
     * Also, we want to ensure that our react application node is there.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->actingAsUser()
            ->get(route('surveys.create'))
            ->assertSuccessful()
            ->assertViewIs('surveys.create')
            ->assertSee('<div id="create-survey"></div>');
    }

    /**
     * We want to ensure that when we select a survey from the listing page, we see a detail page for it.
     * @return void
     */
    public function testShow()
    {
        $survey = $this->createSurveysForUser(1)
            ->first();

        $this->actingAsUser()
            ->get(route('surveys.show', $survey->id))
            ->assertSuccessful()
            ->assertViewIs('surveys.show')
            ->assertSee($survey->title);
    }


    /**
     * This tests the json api for creating a survey. This api is used by the react application that renders on the page.
     * @return void
     */
    public function testApiForCreatingSurvey()
    {
        $payload = factory(Survey::class)->make()->toArray();

        // Let's authenticate with Passport
        Passport::actingAs($this->user);

        $this->postJson(route('surveys.store'), $payload)
            ->assertStatus(201)
            ->assertJsonFragment($payload);
    }
}
