<?php

namespace App\Enums;

use Illuminate\Support\Collection;


enum Role
{
    case ADMIN;

    case USER;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::USER => 'user',
        };
    }

    public static function collection(): Collection
    {
        return collect(self::cases())->map(fn ($i) => $i->toString());
    }
}
