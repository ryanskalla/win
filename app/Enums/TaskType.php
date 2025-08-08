<?php

namespace App\Enums;

enum TaskType: string
{
    case Call = 'call';
    case Do = 'do';
    case Go = 'go';

    public function label(): string
    {
        return match ($this) {
            self::Call => 'Call',
            self::Do => 'Do',
            self::Go => 'Go',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Call => 'phone',
            self::Do => 'check',
            self::Go => 'arrow-right',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Call => 'blue',
            self::Do => 'green',
            self::Go => 'red',
        };
    }

    public function order(): int
    {
        return match ($this) {
            self::Call => 1,
            self::Do => 2,
            self::Go => 3,
        };
    }
}
