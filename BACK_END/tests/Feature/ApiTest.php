<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function test_if_the_api_user_path_returns_successfull()
    {
        $response = $this->get('/api/user');

        $response->assertStatus(200);
    }

    public function test_if_the_user_delete_path_returns_successfull()
    {
        $response = $this->delete('/api/delete/9');

        $response->assertStatus(200);
    }
}
