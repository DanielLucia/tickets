<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class checkLoginTest extends TestCase
{
    /** @test */
    public function check_login()
    {
        $this->get('/')
        ->assertStatus(301);
    }

    /** @test */
    public function check_login_text()
    {
        $this->get('/login')
        ->assertStatus(200)
        ->assertSee('E-Mail Address');
    }
}
