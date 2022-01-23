<?php

namespace Tests\Feature;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function profile()
    {
        $user = User::where('email', 'test@test.com')->first();
        $this->actingAs($user);

        $response = $this->getJson(route('profiles.show'));
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'user_id',
            ]
        ]);
        $content = json_decode($response->content(), true);

        return [
            'user' => $user,
            'profile' => $content['data']
        ];
    }

    /**
     * @test
     * @depends profile
     * @param array $inst
     */
    public function profileUpdate(array $inst)
    {
        $this->actingAs($inst['user']);
        $profile = $inst['profile'];

        $profile['first_name'] = 'Updated';

        $response = $this->putJson(route('profiles.update'), $profile);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'user_id',
            ]
        ]);

        $content = json_decode($response->content(), true);

        $this->assertEquals($content['data']['first_name'], 'Updated');
    }
}
