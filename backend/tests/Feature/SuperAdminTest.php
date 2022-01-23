<?php

namespace Tests\Feature;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserTest extends TestCase
{
    use TestTrait;

    /**
     * @test
     */
    public function login()
    {
        $response = $this->postJson(route('login'), ['username' => 'admin', 'password' => 'admin123']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
            ]
        ]);

        $data = $this->getData($response->content(), 'data');

        $user = User::find($data['id']);

        $this->assertNotEquals($user, null);

        return [
            'user' => $user,
        ];
    }

    /**
     * @test
     * @depends login
     * @param $inst
     */
    public function dashboard($inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('dashboard'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'
        ]);

        $response = $this->getJson(route('test'));
        $response->assertStatus(200);

        return $inst;
    }

}
