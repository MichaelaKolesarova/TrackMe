<?php

namespace App\Helpers\DataStructures;

enum TaskStatusEnum: int
{
    case ToDo = 1;
    case InProgress = 2;
    case Blocked = 3;
    case Done = 4;


    public static function toString($value): string
    {
        switch ($value) {
            case self::ToDo:
                return "To Do";
            case self::InProgress:
                return "In Progress";
            case self::Blocked:
                return "Blocked";
            case self::Done:
                return "Done";
            default:
                return "Unknown Status";
        }
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
