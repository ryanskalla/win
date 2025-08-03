<?php

namespace App;

enum Quadrant: string
{
    case UrgentAndImportant = 'urgent_and_important';
    case NotUrgentButImportant = 'not_urgent_but_important';
    case UrgentButNotImportant = 'urgent_but_not_important';
    case NotUrgentAndNotImportant = 'not_urgent_and_not_important';

    public function label(): string
    {
        return match ($this) {
            self::UrgentAndImportant => 'Urgent and Important',
            self::NotUrgentButImportant => 'Not Urgent but Important',
            self::UrgentButNotImportant => 'Urgent but Not Important',
            self::NotUrgentAndNotImportant => 'Not Urgent and Not Important',
        };
    }

    public function action(): string
    {
        return match ($this) {
            self::UrgentAndImportant => 'Avoid',
            self::NotUrgentButImportant => 'Delegate',
            self::UrgentButNotImportant => 'Schedule',
            self::NotUrgentAndNotImportant => 'Eliminate',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::UrgentAndImportant => 'red',
            self::NotUrgentButImportant => 'yellow',
            self::UrgentButNotImportant => 'green',
            self::NotUrgentAndNotImportant => 'blue',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::UrgentAndImportant => 'exclamation-triangle',
            self::NotUrgentButImportant => 'exclamation-triangle',
            self::UrgentButNotImportant => 'exclamation-triangle',
            self::NotUrgentAndNotImportant => 'exclamation-triangle',
        };
    }
}
