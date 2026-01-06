<?php

namespace App\Repositories;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    public function create(UserDTO $dto): User
    {

        $user = new User;
        $this->fill($dto, $user);

        $user->status = $dto->status;
        $user->password = $dto->password;
        $user->email = $dto->email;

        $user->save();

        return $user;
    }

    public function update(UserDTO $dto, User $user): User
    {
        $this->fill($dto, $user);
        $user->save();

        return $user;
    }

    public function fill(UserDTO $dto, User $user): User
    {
        $allowed = ['first_name', 'last_name', 'role_id', 'phone'];

        foreach ($allowed as $attr) {
            if ($dto->$attr !== null) {

                $user->$attr = $dto->$attr;
            }
        }

        if ($dto->avatar instanceof UploadedFile) {
            if ($user->avatar !== null && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $user->avatar = $dto->avatar->store('users/avatars');
        }

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }
}
