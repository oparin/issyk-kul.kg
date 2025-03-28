<?php

namespace App\Enums;

enum Currency: string
{
    case USD = 'usd';
    case KGS = 'kgs';

    public function alias(): string
    {
        return match ($this) {
            self::USD => 'USD',
            self::KGS => 'KGS',
        };
    }
}
