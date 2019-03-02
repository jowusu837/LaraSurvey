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
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCompleteAndSubmitSurvey()
    {

    }
}
