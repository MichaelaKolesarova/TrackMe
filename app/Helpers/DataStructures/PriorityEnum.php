<?php

namespace App\Helpers\DataStructures;

enum PriorityEnum: int
{
    case NotImportantNotUrgent = 1;
    case NotImportantUrgent = 2;
    case ImportantNotUrgent = 3;
    case ImportantUrgent = 4;


    public static function toString($value): string
    {
        switch ($value) {
            case self::NotImportantNotUrgent:
                return "Not Important - Not Urgent";
            case self::NotImportantUrgent:
                return "Not Important - Urgent";
            case self::ImportantNotUrgent:
                return "Important - Not Urgent";
            case self::ImportantUrgent:
                return "Important - Urgent";
            default:
                return "Unknown Status";
        }
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
