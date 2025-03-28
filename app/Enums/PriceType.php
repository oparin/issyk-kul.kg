<?php

namespace App\Enums;

enum PriceType: string
{
    case PER_PERSON    = 'per_person';
    case PER_APARTMENT = 'per_apartment';

    public function alias(): string
    {
        return match ($this) {
            self::PER_PERSON    => 'С человека',
            self::PER_APARTMENT => 'За апартаменты',
        };
    }
}
