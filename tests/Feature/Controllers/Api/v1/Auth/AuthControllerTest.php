<?php

namespace Tests\Feature\Controllers\Api\v1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * Test Login Success
     */
    public function testLoginSuccess()
    {
        \Artisan::call('passport:install --force');
        $passport = \Artisan::output();
        preg_match_all('/Client ID:\s\w+/mi', $passport, $match_id);
        preg_match_all('/Client secret:\s\w+/mi', $passport, $match_secret);
        $match_id = reset($match_id);
        $match_secret = reset($match_secret);
        if ($match_id && $match_secret) {
            preg_match('/\w+$/mi', $match_id[1], $client_id);
            preg_match('/\w+$/mi', $match_secret[1], $client_secret);
            $client_id = reset($client_id);
            $client_secret = reset($client_secret);

            $user_pass = '@HUNG12345678';
            $user_adm  = User::factory()
                            ->state([
                                'active'   => 1,
                                'password' => \Hash::make($user_pass)
                            ])
                            ->create();
            $credential = [
                'username'      => $user_adm->email,
                'password'      => $user_pass,
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'grant_type'    => 'password',
            ];

            $response = $this->json('POST', '/oauth/token', $credential, ['Accept' => 'application/json']);
            $response
                ->assertStatus(Response::HTTP_OK)
                ->assertJsonStructure(['token_type','expires_in','access_token','refresh_token']);
        }
    }
}
