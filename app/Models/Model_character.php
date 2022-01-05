<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Model_character
{
    public static function getCharacter($id)
    {
        $character = DB::select('
            SELECT 
                * 
            FROM
                t_character
            WHERE
                no = ?
        ', [$id]);
        return $character;
    }

    public static function getCharacterList()
    {
        $characters = DB::select('
            SELECT 
                * 
            FROM 
                t_character
        ');
        return $characters;
    }
}
