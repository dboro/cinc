<?php

namespace Tests\Feature;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // use RefreshDatabase;

    public $auth = [];

    /**
     * @test
     */
    public function registerFail422()
    {
        $response = $this->postJson(route('registration'), []);
        $response->assertStatus(422);
    }

    /**
     * @test
     * @depends registerFail422
     */
    public function register()
    {
        Notification::fake();
        // проверка ответ
        $data = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->postJson(route('registration'), $data);

        $response->assertStatus(200);

        // проверяем в базе
        $user = User::where('email', $data['email'])->first();
        $this->assertNotEquals($user, null, 'User didn\'t add do DB');

        // проверка ответа
        $response->assertJsonStructure([
            'data' => [
                'id',
                'email'
            ]
        ]);

        $mailData = [];

        Notification::assertSentTo(
            $user,
            VerifyEmail::class,
            function ($notification, $channels) use ($user, &$mailData) {
                // retrive the mail content
                $mailData = $notification->toMail($user)->toArray();
                return true;
            }
        );

        $this->assertArrayHasKey('actionUrl', $mailData);
        $url = $mailData['actionUrl'];

        return [
            'url' => $url,
            'user' => $user
        ];
    }

    /**
     * @test
     * @depends register
     * @param array $inst
     *
     * @return array $inst
     */
    public function verify(array $inst)
    {
        /** @var User $user */
        $user = $inst['user'];
        $this->actingAs($user);
        $url = str_replace('/verify', '/api/email/verify', $inst['url']);
        // статус
        $response = $this->getJson($url);

        $response->assertStatus(200);

        // прошла ли верификация
        $user->refresh();
        $this->assertEquals($user->hasVerifiedEmail(), true, 'Верификаця не прошла');

        return $inst;
    }

    /**
     * @test
     * @depends verify
     * @param array $inst
     * @return array
     */
    public function dashboard(array $inst)
    {
        /** @var User $user */
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('dashboard'));

        $response->assertStatus(200);

        return $inst;
    }

    /**
     * @test
     * @depends dashboard
     * @param array $inst
     * @return array
     */
    public function logout(array $inst)
    {
        /** @var User $user */
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('logout'));

        $response->assertStatus(200);

        return $inst;
    }


    /**
     * @test
     * @depends logout
     * @param array $inst
     * @return array
     */
    public function passwordEmail(array $inst)
    {
        /** @var User $user */
        $user = $inst['user'];
        Notification::fake();

        // проверка статуса
        $response = $this->postJson(route('passport.email', ['email' => $user->email]));

        $response->assertStatus(200);

        $mailData = [];
        Notification::assertSentTo(
            $user,
            ResetPassword::class,
            function ($notification, $channels) use ($user, &$mailData) {
                // retrive the mail content
                $mailData = $notification->toMail($user)->toArray();
                return true;
            });
        $this->assertArrayHasKey('actionUrl', $mailData);
        $inst['url'] = $mailData['actionUrl'];

        return $inst;
    }

    /**
     * @test
     * @depends passwordEmail
     * @param $inst
     */
    public function passwordReset($inst)
    {
        // выделяем токен
        $arr = explode('/', $inst['url']);
        $token = $arr[4];

        $data = [
            'email' => 'test@test.com',
            'token' => $token,
            'password' => 'new_password',
            'password_confirmation' => 'new_password'
        ];
        $response = $this->postJson(route('password.reset'), $data);

        $response->assertStatus(200);
    }

    /**
     * @test
     * @depends passwordReset
     */
    public function login()
    {
        // проверка статуса
        $data = ['email' => 'test@test.com', 'password' => 'new_password'];
        $response = $this->postJson(route('login'), $data);

        $response->assertStatus(200);

        // проверка ответа
        $response->assertJsonStructure([
            'data' => [
                'id',
                'email'
            ]
        ]);

        $content = json_decode($response->content(), true);

        $user = User::query()->find($content['data']['id']);

        return [
            'user' => $user
        ];
    }

    /**
     * @test
     * @depends login
     * @param array $inst
     * @return array
     */
    public function dashboardRepeat(array $inst)
    {
        return $this->dashboard($inst);
    }
}
