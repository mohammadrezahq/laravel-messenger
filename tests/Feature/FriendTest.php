<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Chat;
use App\Models\User;
use Tests\TestCase;

class FriendTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_a_message()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $chat = new Chat();
        $chat->users = json_encode([$user->id, $user2->id]);
        $chat->save();

        $this->actingAs($user);

        $response = $this->post('/messages/send', [
            'chat_id' => $chat->id,
            'message' => 'hello'
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'hello'
        ]);
    }
}
