<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {

        protected string $secret;

        protected int $ttl;

        protected string $issuer;

        public function __construct() {
            $this->secret = env('JWT_SECRET');
            $this->ttl = env('JWT_TTL');
            $this->issuer = env('JWT_ISSUER');
        }

        /**
         * @param array $claims
         * @return string
         */

        public function makeAccessToken(array $claims) {
            $now = time();
            $payload = array_merge($claims, [
                'iss' => $this->issuer,
                'iat' => $now,
                'nbf' => $now,
                'exp' => $now + $this->ttl,
            ]);

            return JWT::encode($payload, $this->secret, 'HS256');
        }

        public function decodeAccessToken(string $token) {
            try {
                JWT::$leeway=60;
                return JWT::decode($token, new Key($this->secret, 'HS256'));
            } catch (\Exception $e) {
                //do nothing
                return null;
            }
        }
}
