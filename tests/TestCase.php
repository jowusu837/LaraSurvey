<?php

namespace Tests;

use App\Survey;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Our test user
     * @var User
     */
    private $user;


    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');

        // We will be authenticating as this user
        $this->user = factory(User::class)->create();
    }

    /**
     * This helper function helps us to be dry
     * @return TestCase
     */
    protected function actingAsUser(): TestCase
    {
        return $this->actingAs($this->user);
    }

    /**
     * Create surveys for our test user
     * @param int $count
     * @return Collection|iterable
     */
    protected function createSurveysForUser($count = 1)
    {
        // Create surveys
        $surveys = $this->user->surveys()->saveMany(factory(Survey::class, $count)->make());

        // Add 5 questions to each survey
        $surveys->each(function ($survey) {
            $survey->questions()->saveMany(factory(\App\Question::class, 5)->make());
        });

        // then return surveys
        return $surveys;
    }
}
