<?php

namespace Tests\Unit;

use App\Actors;
use Tests\TestCase;
use Auth;
use App\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class ExampleTest extends TestCase
{


    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);


    }
}
