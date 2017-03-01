<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use User;

use Faker\Factory as Faker;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    private $faker = null;

    const FAKE_URL = 'https://AFakeURL.com';
    const HTTP_REQUEST_REF = [
        'HTTP_REFERER' => self::FAKE_URL,
    ];

    public function setup(){
        parent::setup();
        $this->faker = Faker::create();
    }

    /**
     * Test to assure that you cannot view information without a verified email address.
     *
     * @return void
     */
    public function testEmailVerificationAuthentication()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->call('GET', '/home', [], [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(route('waiting'), "Does not get redirected to waiting route when not verified");

        $verified_user = factory(\App\User::class)->states('email_verified')->create();

        $this->actingAs($verified_user)
            ->call('GET', route('home'), [], [], [], self::HTTP_REQUEST_REF)
            ->assertStatus(200, "Cannot view homepage when verified.");

        $this->actingAs($verified_user)
            ->call('GET', route('waiting'), [], [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(route('home'), "Does not redirect to home when verified.");

        $this->actingAs($verified_user)
            ->call('GET', route('verify', ['token' => 'SomeRandomToken']), [], [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(route('home'), "Does not redirect to home when verified.");

        $this->actingAs($verified_user)
            ->call('GET', url('login'), [], [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(route('home'), "Does not redirect to home when verified.");
    }

    /**
     * Test to assure that you cannot register with 'invalid' information.
     *
     * @return void
     */
    public function testRegistration()
    {
        $faker = Faker::create();
        $valid_data = [
            'name' => 'Test User',
            'email' => 'test@bibz.biz',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $this->call('POST', '/register', $valid_data, [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(route('home'), "Does not get redirected to /home after registering");

        $this->call('POST', '/logout')
            ->assertRedirect(url('/'), "Does not redirect to index after logout");

        $param_copy = $valid_data;

        $param_copy['email'] = $this->faker->email;

        $this->call('POST', '/register', $param_copy, [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(self::FAKE_URL, "Does not block unknown email addresses")
            ->assertSessionHasErrors([
                'email'
                ], "Does not supply correct error message for invalid email registration");
    }

    /**
     * Test to assure that you cannot register with 'invalid' information.
     *
     * @return void
     */
    public function testEmailVerification()
    {
        $user = factory(\App\User::class)->create();
        $this->call('GET', route('verify', ['token' => $user->email_token]), [], [], [], self::HTTP_REQUEST_REF)
            ->assertRedirect(url('/login'), "Does not get redirected to waiting route when not verified")
            ->assertSessionHas(['verification_succes'], "Does not supply verification success message");
    }
}
