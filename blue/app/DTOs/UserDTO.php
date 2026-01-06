<?php

namespace App\DTOs;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Http\UploadedFile;

class UserDTO
{
    public function __construct(
        public readonly ?string $first_name,
        public readonly ?string $last_name,
        public readonly ?string $email,
        public readonly ?string $password,
        public readonly ?UserRole $role_id,
        public readonly ?UserStatus $status,
        public readonly ?UploadedFile $avatar,
        public readonly ?string $phone
    ) {}

    public static function fromArray(array $data): UserDTO
    {

        return new self(
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            email: $data['email'] ?? null,
            password: $data['password'] ?? null,
            role_id: isset($data['role_id']) ? UserRole::from($data['role_id']) : null,
            status: $data['status'] ?? null,
            avatar: $data['avatar'] ?? null,
            phone: $data['phone'] ?? null,
        );
    }
}
