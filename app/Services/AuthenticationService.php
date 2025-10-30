<?php

namespace App\Services;

use App\Models\login;
use App\Models\User;
use App\Repositories\Interfaces\UserRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthenticationService {
    public function __construct(private UserRepo $repo) {

    }

    public function attemptLogin(Login $login) {
        $user = $this -> repo -> getUserByEmail($login -> getEpost());

        if($user && Hash::check($login -> getLosenord(), $user -> losenord)) {
            return $user;
        }
        
        return null;
    }

    /** 
     * Access-token (kortlivad)
     * Innehåller användar-id så vi slipper läsa databas
     * för att få reda på vem användaren är
     * @param User $user
     * @return string
    */

    public function createAccessTokensForUser(User $user):string {
        $claims = [
            'sub' => (string) $user -> id,
            'email' => $user -> email,
            'roles' => $user -> admin ? ['admin'] : []
        ];

        return app(JwtService::class)->makeAccessToken($claims);
    }

    /**
     * @param User $user
     * @return string
     * @throws \Random\RandomException
     */

    public function createAndStoreRefreshToken(User $user) :string {
        $raw = bin2hex(random_bytes(20));
        $hash = hash('sha256', $raw);
        $expiresAt = Carbon::now() -> addSeconds (env('REFRESH_TTL', 10000));
        $user -> refresh_token_hash = $hash;
        $user -> refresh_token_expires_at = $expiresAt -> toDateTimeString();

        //Uppdatera användaren
        $this -> repo -> update($user);
        return $raw;
    }

    public function validateRefreshToken(string $rawToken):?User {
        $hash = hash('sha256', $rawToken);
        $user = $this -> repo -> findUserByRefreshTokenHash($hash);

        //Ingen användare hittades
        if(!$user) {
            return null;
        }

        //Expires är mindre än nu
        if($user -> refresh_token_expires_at && strtotime($user -> refresh_token_expires_at) < time()) {
            return null;
        }
        return $user;
    }
}