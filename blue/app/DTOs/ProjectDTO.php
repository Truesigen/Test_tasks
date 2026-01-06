<?php

namespace App\DTOs;

class ProjectDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $status,
        public readonly int $created_by
    ) {}

    public static function fromArray(array $data): ProjectDTO
    {
        return new self(
            name: $data['name'],
            description: $data['description'],
            status: $data['status'],
            created_by: $data['created_by']
        );
    }
}
