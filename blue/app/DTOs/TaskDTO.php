<?php

namespace App\DTOs;

class TaskDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $status,
        public readonly string $priority,
        public readonly int $project_id,
        public readonly ?int $assigned_to,
        public readonly int $created_by,
        public readonly string $due_date
    ) {}

    public static function fromArray(array $data): TaskDTO
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            status: $data['status'],
            priority: $data['priority'],
            project_id: $data['project_id'],
            assigned_to: $data['assigned_to'] ?? null,
            created_by: $data['created_by'],
            due_date: $data['due_date']
        );
    }
}
