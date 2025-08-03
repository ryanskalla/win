<?php

namespace App;

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
}
