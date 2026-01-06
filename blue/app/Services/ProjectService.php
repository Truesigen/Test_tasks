<?php

namespace App\Services;

use App\DTOs\ProjectDTO;
use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectService
{
    public function __construct(public readonly ProjectRepository $repository) {}

    public function store(ProjectDTO $dto): Project
    {
        return $this->repository->create($dto);
    }

    public function update(ProjectDTO $dto, Project $project): Project
    {
        return $this->repository->update($dto, $project);
    }
}
