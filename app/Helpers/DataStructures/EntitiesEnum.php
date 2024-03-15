<?php

namespace App\Helpers\DataStructures;

enum EntitiesEnum: int
{
    case Task = 1;
    case Project = 2;
    case Team = 3;
    case Person = 4;



    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function toString(): string
    {
        switch ($this) {
            case self::Task:
                return 'Task';
            case self::Project:
                return 'Project';
            case self::Team:
                return 'Team';
            case self::Person:
                return 'Personal';
            default:
                throw new \InvalidArgumentException("Invalid enum value");
        }
    }
}
