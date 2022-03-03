<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Friend;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_friend()
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        $user2 = User::factory()->create();

        $response = $this->post('/friends/add', [
            'email' => $user2->email
        ]);

        $response->assertStatus(201)->assertJson([
            'status' => 'pending'
        ]);

    }

    public function test_user_can_accept_friend()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $this->actingAs($user);

        $friend = new Friend();
        $friend->users = json_encode([$user->id, $user2->id]);
        $friend->data = json_encode(['pending' => $user->id]);
        $friend->status = 'pending';
        $friend->save();

        $response = $this->put('/friends/update', [
            'id' => $user2->id,
            'action' => 'accept'
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_deny_friend()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $this->actingAs($user);

        $friend = new Friend();
        $friend->users = json_encode([$user->id, $user2->id]);
        $friend->data = json_encode(['pending' => $user->id]);
        $friend->status = 'pending';
        $friend->save();

        $response = $this->put('/friends/update', [
            'id' => $user2->id,
            'action' => 'deny'
        ]);

        $response->assertStatus(200);
    }
}
