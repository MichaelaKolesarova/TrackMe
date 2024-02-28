<?php

namespace App\Helpers\DataStructures;

enum TaskActivitiesEnum: int
{
    case Create = 1;
    case UpdateAssignee = 2;
    case UpdateDueDate = 3;
    case UpdatePriority = 4;
    case UpdateTaskStatus = 5;
    case CreateChildTask = 6;
    case UpdateTeamAssignedTo = 7;


    public static function toString($value): string
    {
        switch ($value) {
            case self::Create:
                return "created this task";
            case self::UpdateAssignee:
                return "updated Assignee to";
            case self::UpdateDueDate:
                return "updated Due Date to";
            case self::UpdatePriority:
                return "updated Priority to";
            case self::UpdateTaskStatus:
                return "updated Task Status to";
            case self::CreateChildTask:
                return "created Child Task";
            case self::UpdateTeamAssignedTo:
                return "update Team Assigned To";
            default:
                return "Unknown Activity";
        }
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
