<?php

namespace App\DTOs;

class AuthDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromArray(array $data): AuthDTO
    {
        return new self(email: $data['email'], password: $data['password']);
    }
}
