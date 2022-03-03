<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_cant_be_redirected_on_guest()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_home_page_can_be_rendered_on_authenticated_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_friends_page_cant_be_rendered_on_guest()
    {
        $response = $this->get('/friends');
        $response->assertStatus(302);
    }

    public function test_friends_page_can_be_rendered_on_authenticated_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/friends');

        $response->assertStatus(200);
    }
}
