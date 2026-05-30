<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RoleEnum: string implements HasLabel
{
    case User = 'user';
    case Admin = 'admin';
    case SuperAdmin = 'super admin';

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(
            fn (self $role): string => $role->value,
            self::cases(),
        );
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::User => 'User',
            self::Admin => 'Admin',
            self::SuperAdmin => 'Super Admin',
        };
    }
}
