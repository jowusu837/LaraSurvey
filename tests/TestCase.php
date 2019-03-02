<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }


    /**
     * @param TestResponse $response
     * @param $key
     * @return mixed
     */
    protected function getResponseData($response, $key){
        $content = $response->getOriginalContent();
        $content = $content->getData();
        return $content[$key]->all();
    }
}
