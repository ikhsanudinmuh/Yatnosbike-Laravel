<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    { 
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function it_login_user() {
        $user = new User();

        $password = Hash::make('ikhsan123');

        $response = $this->actingAs($user)
            ->post(route('loginUserPost'), [
                'email' => 'ikhsan@gmail.com',
                'password' => $password
            ]);

        $response->assertRedirect(route('productIndex'));

    }
    public function it_login_admin() {
        $user = new User();

        $password = Hash::make('ikhsan123');

        $response = $this->actingAs($user)
            ->post(route('loginUserPost'), [
                'email' => 'ikhsan@gmail.com',
                'password' => $password
            ]);

        $response->assertRedirect(route('productIndex'));

    }
    public function it_login_seller() {
        $user = new User();

        $password = Hash::make('ikhsan123');

        $response = $this->actingAs($user)
            ->post(route('loginUserPost'), [
                'email' => 'ikhsan@gmail.com',
                'password' => $password
            ]);

        $response->assertRedirect(route('productIndex'));

    }
}
