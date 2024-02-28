<?php

namespace App\Helpers\DataStructures;

enum ProjectActivitiesEnum: int
{
    case Create = 1;
    case UpdateTeamLead = 2;
    case CreatedNewRootTask = 3;
    case CreatedNewSubtask = 4;



    public static function toString($value): string
    {
        switch ($value) {
            case self::Create:
                return "created this project";
            case self::UpdateTeamLead:
                return "updated team lead to";
            case self::CreatedNewRootTask:
                return "created new root task";
            case self::CreatedNewSubtask:
                return "created new subtask";
            default:
                return "Unknown Activity";
        }
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
