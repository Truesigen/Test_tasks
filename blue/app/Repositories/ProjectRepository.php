<?php

namespace App\Repositories;

use App\DTOs\ProjectDTO;
use App\Models\Project;

class ProjectRepository
{
    public function create(ProjectDTO $dto): Project
    {
        $project = new Project;

        $this->fill($dto, $project);
        $project->created_by = $dto->created_by;

        $project->save();

        return $project;
    }

    public function update(ProjectDTO $dto, Project $project): Project
    {
        $this->fill($dto, $project);

        $project->save();

        return $project;
    }

    public function fill(ProjectDTO $dto, Project $project): Project
    {
        $project->name = $dto->name;
        $project->description = $dto->description;
        $project->status = $dto->status;

        return $project;
    }
}
