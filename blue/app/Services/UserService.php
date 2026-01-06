<?php

namespace App\Services;

use App\DTOs\AuthDTO;
use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(public readonly UserRepository $repository) {}

    public function store(UserDTO $dto): User
    {

        return $this->repository->create($dto);
    }

    public function login(AuthDTO $dto): string
    {
        $user = $this->repository->findByEmail($dto->email);

        if (! $user) {
            throw ValidationException::withMessages(['email' => 'Invalid email']);
        }

        if (! Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages(['password' => 'Invalid password']);
        }

        return $user->createToken($dto->email.uniqid())->plainTextToken;
    }

    public function update(UserDTO $dto, User $user): User
    {
        return $this->repository->update($dto, $user);
    }
}
