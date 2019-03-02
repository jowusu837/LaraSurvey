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
     * A user should be able to see a list of surveys he or she has created
     *
     * @return void
     */
    public function testListing()
    {
        // Let's create a user with some surveys
        $user = factory(User::class)->create();

        $surveys = $user->surveys()->saveMany(factory(Survey::class, 5)->make());

        $response = $this->actingAs($user)
            ->get(route('surveys.index'))
            ->assertSuccessful()
            ->assertViewHas('surveys');

        $viewData = $this->getResponseData($response, 'surveys');

        $this->assertEquals(count($viewData), count($surveys));
    }
}
