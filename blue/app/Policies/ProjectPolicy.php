<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function update(User $user, Project $project): bool
    {
        if ($user->is_admin || $user->id == $project->created_by) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Project $project): bool
    {

        if ($user->is_admin || $user->id == $project->created_by) {
            return true;
        }

        return false;
    }
}
