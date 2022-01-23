<?php

namespace Tests\Feature;

use App\Jobs\MemberAfterCreateJob;
use App\Models\Company;
use App\Models\Member;
use App\Notifications\InviteMember;
use App\Notifications\VerifyEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use TestTrait;
    /**
     * @test
     *
     * @return void
     */
    public function serviceIndex()
    {
        $user = User::where('email', 'test@test.com')->first();
        $this->actingAs($user);

        $response = $this->getJson(route('services.index'));
        $response->assertStatus(200);

        return [
            'user' => $user,
            'services' => $this->getData($response->content(), 'items')
        ];
    }

    /**
     * @test
     * @depends serviceIndex
     *
     * @param array $inst
     * @return array
     */
    public function entityStore(array $inst)
    {
        $user = $inst['user'];
        $services = $inst['services'];
        $this->actingAs($user);

        $data = [
            'title' => 'Entity 1',
            'invite_subject' => 'Invitation subject',
            'invite_text' => 'Invitation text',
            'services_ids' => Arr::pluck($services, 'id')
        ];

        $response = $this->postJson(route('entities.store'), $data);

        $response->assertStatus(200);

        return $inst;
    }

    /**
     * @test
     * @depends entityStore
     * @param array $inst
     * @return array
     */
    public function entityIndex(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('entities.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'items' => [['id']]
        ]);

        $content = json_decode($response->content(), true);
        $inst['id'] = $content['items'][0]['id'];

        return $inst;
    }

    /**
     * @test
     * @depends entityIndex
     * @param array $inst
     * @return array
     */
    public function entityShow(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('entities.show', ['id' => $inst['id']]).'?include=services');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'item' => ['id']
        ]);

        $content = json_decode($response->content(), true);

        $inst['entity_id'] = $content['item']['id'];

        return $inst;
    }

    /**
     * @test
     * @depends entityShow
     * @param array $inst
     * @return array
     */
    public function entityUpdate(array $inst)
    {
        $user = $inst['user'];
        $services = $inst['services'];
        $this->actingAs($user);

        $data = [
            'title' => 'Entity Updated',
            'invite_subject' => 'Invitation subject',
            'invite_text' => 'Invitation text',
            'services_ids' => Arr::pluck($services, 'id')
        ];

        $response = $this->putJson(route('entities.update', ['id' => $inst['entity_id']]), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'item' => ['id']
        ]);

        $content = json_decode($response->content(), true);
        $this->assertEquals($content['item']['title'], $data['title']);

        return $inst;
    }

    /**
     * @test
     * @depends entityUpdate
     * @param array $inst
     * @return array
     */
    public function entityIncludeRoles(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);

        $response = $this->getJson(route('entities.show',
                ['id' => $inst['entity_id']]).'?include=roles&fields[roles]=roles.id,roles.name');
        $response->assertStatus(200);

        $item = $this->getData($response->content(), 'item');

        $inst['entity'] = $item;
        return $inst;
    }

    /**
     * @test
     * @depends entityIncludeRoles
     * @param array $inst
     * @return array
     */
    public function memberStore(array $inst)
    {
        Queue::fake();
        Notification::fake();
        $user = $inst['user'];
        $entity = $inst['entity'];
        $this->actingAs($user);

        $email = '777-'.uniqid().'@test.com';
        $data = [
            'email' => $email,
            'invite_subject' => $entity['invite_subject'],
            'invite_text' => $entity['invite_text'],
            'roles' => Arr::pluck($entity['roles'], 'id')
        ];

        $response = $this->postJson(route('members.store', ['entityId' => $entity['id']]), $data);
        $response->assertStatus(200);

        $member = Member::query()->where('email', $email)->first();
        $inst['member'] = $member;

        Queue::assertPushed(
            MemberAfterCreateJob::class,
            function ($job) use ($member) {

                if ($job->member->id === $member->id) {
                    $job->handle();
                    return true;
                }
                else {
                    return false;
                }
            }
        );
        $newUser = User::query()->where('email', $email)->first();

        $mailData = [];

        Notification::assertSentTo(
            $newUser,InviteMember::class,
            function ($notification, $channels) use ($newUser, &$mailData) {
                $mailData = $notification->toMail($newUser)->toArray();
                return true;
            });

        $inst['url'] = $mailData['actionUrl'];

        return $inst;
    }

    /**
     * @test
     * @depends memberStore
     * @param array $inst
     * @return array
     */
    public function memberIndex(array $inst)
    {
        $user = $inst['user'];
        $entity = $inst['entity'];
        $this->actingAs($user);

        $response = $this->getJson(route('members.index', ['entityId' => $entity['id']]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'items' => [['id']]
        ]);

        $inst['members'] = $this->getData($response->content(), 'items');

        return $inst;
    }

    /**
     * @test
     * @depends memberIndex
     * @param array $inst
     * @return array
     */
    public function memberDestroy(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);
        $member = $inst['members'][0];

        $response = $this->deleteJson(route('members.destroy', ['id' => $member['id']]));
        $response->assertStatus(200);

        $inst['deletedMember'] = $member;

        return $inst;
    }

    /**
     * @test
     * @depends memberDestroy
     * @param array $inst
     * @return array
     */
    public function memberArchive(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);
        $entity = $inst['entity'];
        $member = $inst['deletedMember'];

        $response = $this->getJson(route('members.archive', ['entityId' => $entity['id']]));
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'items' => [['id']]
        ]);

        $items = $this->getData($response->content(), 'items');
        $itemsArr = Arr::pluck($items, 'id');

        $this->assertEquals(in_array($member['id'], $itemsArr), true);

        return $inst;
    }

    /**
     * @test
     * @depends memberArchive
     * @param array $inst
     * @return array
     */
    public function memberRestore(array $inst)
    {
        $user = $inst['user'];
        $this->actingAs($user);
        $entity = $inst['entity'];
        $member = $inst['deletedMember'];

        $response = $this->deleteJson(route('members.restore', ['id' => $member['id']]));
        $response->assertStatus(200);

        $items = Member::query()->where('entity_id', $entity['id'])->get()->all();
        $itemsArr = Arr::pluck($items, 'id');

        $this->assertEquals(in_array($member['id'], $itemsArr), true);

        return $inst;
    }

    /**
     * @test
     * @depends memberStore
     * @param array $inst
     * @return array
     */
    public function agreement(array $inst)
    {
        $arr = explode('/', $inst['url']);

        Notification::fake();
        // проверка ответ
        $data = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => urldecode( $arr['4']),
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];

        $response = $this->postJson(route('agreement', ['email' => $arr['4'], 'token' => $arr[5]]), $data);
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

        $inst['newUser'] = $user;
        $inst['url'] = $mailData['actionUrl'];

        return $inst;
    }

    /**
     * @test
     * @depends agreement
     * @param array $inst
     *
     * @return array $inst
     */
    public function verify(array $inst)
    {
        /** @var User $user */
        $user = $inst['newUser'];
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
     *
     * @return array $inst
     */
    public function memberConfirmedNo(array $inst)
    {
        /** @var User $user */
        $user = $inst['newUser'];
        /** @var Member $member */
        $member = $inst['member'];
        $this->actingAs($user);

        $response = $this->putJson(route('members.confirmed', ['id' => $member->id]), ['value' => Member::CONFIRMED_NO]);
        $response->assertStatus(200);

        $member->refresh();

        $this->assertEquals($member->confirmed, Member::CONFIRMED_NO);

        return $inst;
    }

    /**
     * @test
     * @depends memberConfirmedNo
     * @param array $inst
     *
     * @return array $inst
     */
    public function memberResend(array $inst)
    {
        /** @var User $user */
        $user = $inst['user'];
        /** @var Member $member */
        $member = $inst['member'];
        $this->actingAs($user);

        $response = $this->putJson(route('members.resend', ['id' => $member->id]));
        $response->assertStatus(200);

        return $inst;
    }

    /**
     * @test
     * @depends memberResend
     * @param array $inst
     *
     * @return array $inst
     */
    public function memberConfirmedYes(array $inst)
    {
        /** @var User $user */
        $user = $inst['newUser'];
        /** @var Member $member */
        $member = $inst['member'];
        $this->actingAs($user);

        $response = $this->putJson(route('members.confirmed', ['id' => $member->id]), ['value' => Member::CONFIRMED_YES]);
        $response->assertStatus(200);

        $member->refresh();

        $this->assertEquals($member->confirmed, Member::CONFIRMED_YES);

        return $inst;
    }
}
