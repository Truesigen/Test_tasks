<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 1;
    case MANAGER = 2;
    case USER = 3;

    public function permission(): array
    {
        return match ($this) {
            self::ADMIN => ['*'],
            self::MANAGER => [
                'task' => [
                    'create',
                    'update',
                ],
                'project' => [
                    'create',
                    'update',
                ],
            ],
            self::USER => [
                'task' => [
                    'update' => ['status'],
                    'show',
                ],
            ]
        };
    }
}
