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

    public static function insertCharacterList($no, $name_en, $name_kr)
    {
        $query = '
            INSERT INTO
                champion (no, name_en, name_kr)
            VALUES
                (?,?,?)
        ';
        DB::insert($query, [$no, $name_en, $name_kr]);        
    }

    public static function selectCharacterList()
    {
        $query = '
            SELECT 
                name_en
            FROM
                champion
            
        ';

        $name_en = DB::select($query);
        return $name_en;    
    }

    public static function selectCharacterListkr()
    {
        $query = '
            SELECT 
                name_kr
            FROM
                champion
            
        ';

        $name_kr = DB::select($query);
        return $name_kr;    
    }

    public static function insertCharacterskill( $skill_Q, $skill_W, $skill_E, $skill_R)
    {
        $query = '
            INSERT INTO
                champion_skill (skill_Q, skill_W, skill_E, skill_R)
            VALUES
                (?,?,?,?)
        ';
        DB::insert($query, [$skill_Q, $skill_W, $skill_E, $skill_R]);        
    }

    public static function insertitem( )
    {
        $query = '
            INSERT INTO
                item (item_name_kr, image, description)
            VALUES
                (?,?,?)
        ';
        DB::insert($query, []);        
    }

    public static function search_champion($name_kr, $line)
    {
        $wherecharacter = "";
        $whereline = "";
        if(!empty($name_kr)) $wherecharacter = "AND name_kr LIKE ' %"."$name_kr%'";
        if(!empty($line)) $whereline = "AND line LIKE ' %"."$line%'";
        
        
        $query = "
            SELECT 
                name_kr
            FROM
                champion AS c
                JOIN line AS l ON (c.no = l.champion)
            WHERE
                1=1
                $wherecharacter
                $whereline
        " 
                
        ;
        $query1 = htmlspecialchars_decode($query);
        $whatlookingfor = DB::select($query1);
        return $whatlookingfor; 
    }
}
