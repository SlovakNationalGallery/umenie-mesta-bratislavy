<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use WithoutMiddleware; // Disable auth
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home_page_works()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_about_page_works()
    {
        $response = $this->get('/o-projekte');

        $response->assertStatus(200);
    }
}
