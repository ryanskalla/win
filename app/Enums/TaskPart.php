<?php

namespace App;

enum TaskPart: string
{
    case Who = 'who';
    case What = 'what';
    case Why = 'why';
    case When = 'when';
    case Where = 'where';

    public function label(): string
    {
        return match ($this) {
            self::Who => 'Who',
            self::What => 'What',
            self::Why => 'Why',
            self::When => 'When',
            self::Where => 'Where',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Who => 'user',
            self::What => 'question',
            self::Why => 'question',
            self::When => 'calendar',
            self::Where => 'map-marker-alt',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Who => 'blue',
            self::What => 'green',
            self::Why => 'red',
            self::When => 'yellow',
            self::Where => 'purple',
        };
    }
}
