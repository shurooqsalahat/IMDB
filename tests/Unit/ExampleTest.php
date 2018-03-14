<?php

namespace Tests\Unit;
use App\Actors;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }


}
