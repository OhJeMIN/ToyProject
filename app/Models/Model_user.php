<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Model_user
{
    public static function checkUniqueNickname($nickname)
    {
        $user = DB::select('
            SELECT 
                no
            FROM
                t_user
            WHERE
                nickname = ?
        ', [$nickname]);

        return $user;
    }

    public static function checkUniqueEmail($email)
    {
        $user = DB::select('
            SELECT 
                no
            FROM
                t_user
            WHERE
                email = ?
        ', [$email]);

        return $user;
    }

    public static function insertUser($email, $nickname, $password)
    {
        $user = DB::insert('
            INSERT INTO 
                t_user (email, nickname, password)
            VALUES 
                (?, ?, ?)
        ', [$email, $nickname, $password]);
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
