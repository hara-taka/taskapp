<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.show', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee($user->name);
    }

    public function testEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.edit', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee($user->name);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('profile.update', [$user_id => $user->id]));

        $response->assertStatus(200);

        $user->name = 'test_user';
        $user->save();

        $this->assertDatabaseHas('users', [
            'name' => 'test_user'
        ]);
    }

    public function testEditPassword()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('profile.editPassword', [$user_id => $user->id]));

        $response->assertStatus(200);

        $this->assertSee('現在のパスワード');
    }

    public function testUpdatePassword()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('groups.updatePassword', [$user_id => $user->id]));

        $response->assertStatus(200);

        $user->password = 'test_password';
        $user->save();

        $this->assertDatabaseHas('users', [
            'password' => 'test_password'
        ]);
    }
}
