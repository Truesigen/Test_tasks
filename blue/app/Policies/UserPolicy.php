<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $authUser, User $userRecord)
    {
        if ($authUser->id == $userRecord->id || $authUser->is_admin) {
            return true;
        }

        return false;
    }
}
