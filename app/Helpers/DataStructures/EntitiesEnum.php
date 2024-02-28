<?php

namespace App\Helpers\DataStructures;

enum EntitiesEnum: int
{
    case Task = 1;
    case Project = 2;
    case Team = 3;



    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
