<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Uuid;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_an_user_can_view_a_login_form()
    {
        $response = $this->get('/login-admin');
        $response->assertSuccessful();
        $response->assertViewIs('auth.loginadmin');
    }

    // public function test_user_can_login_with_correct_credentials()
    // {
    //     $user = factory(User::class)->create([
    //         'password' => bcrypt('secret'),
    //     ]);
    //     $response = $this->post('/login', [
    //         'username' => $user->email,
    //         'password' => bcrypt('secret'),
    //     ]);
    //     $response->assertRedirect('/');
    //     $this->assertAuthenticatedAs($user);
    // }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(\App\Models\User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
}
