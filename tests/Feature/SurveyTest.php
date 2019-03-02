<?php

namespace Tests\Feature;

use App\Survey;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SurveyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Our test user
     * @var User
     */
    private $user;


    protected function setUp(): void
    {
        parent::setUp();

        // We will be authenticating as this user
        $this->user = factory(User::class)->create();
    }

    /**
     * This helper function helps us to be dry
     * @return SurveyTest
     */
    private function actingAsUser(): SurveyTest
    {
        return $this->actingAs($this->user);
    }

    /**
     * This test is supposed to guarantee that when we create surveys,
     * they get parsed through the controller to the view.
     *
     * @return void
     */
    public function testListing()
    {
        $surveys = $this->user->surveys()->saveMany(factory(Survey::class, 5)->make());

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
     */
    public function testCreate()
    {
        $this->actingAsUser()
            ->get(route('surveys.create'))
            ->assertSuccessful()
            ->assertViewIs('surveys.create')
            ->assertSee('<div id="create-survey"></div>');
    }
}
