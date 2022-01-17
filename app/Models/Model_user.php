<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Model_user
{
    public static function checkUniqueNickname($nickname)
    {
        $query = '
            SELECT 
                no
            FROM
                t_user
            WHERE
                nickname = ?
        ';

        $user = DB::select($query, [$nickname]);

        return $user;
    }

    public static function checkUniqueEmail($email)
    {
        $query = '
            SELECT 
                no
            FROM
                t_user
            WHERE
                email = ?
        ';

        $user = DB::select($query, [$email]);
        return $user;
    }

    public static function insertUser($email, $nickname, $password)
    {
        $query = '
            INSERT INTO 
                t_user (email, nickname, password)
            VALUES 
                (?, ?, ?)
        ';

        DB::insert($query, [$email, $nickname, $password]);
    }
}
