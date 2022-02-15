<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_character;
use PhpParser\Node\Stmt\Echo_;

class PoroController extends Controller
{
    protected $indexValidationRules = [
        'id' => 'required|integer'
    ];
    protected $listValidationRules = [];

    public function index_get(Request $request)
    {
        $this->validator($request, $this->indexValidationRules);
        $character = Model_character::getCharacter($request->id);
        return $character;
    }

    public function list_get(Request $request)
    {
        $character_list = array();

        $this->validator($request, $this->listValidationRules);

        $result = Model_character::getCharacterList($request->id);
        foreach ($result as $character) {
            $character_list[] = array(
                'id' => $character->no,
                'name' => $character->name,
                'line' => $character->line
            );
        }
        return $character_list;
    }

    //챔피언 이름 가져오기
    public function all_get(Request $resquest)
    {
        $name_en = array();
        $name_kr = array();
        $i = 0;
        //이미지 주소
        //https://ddragon.leagueoflegends.com/cdn/12.1.1/img/champion/Jinx.png
        $output = file_get_contents('https://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/champion.json');
        $champion = json_decode($output,true);
        foreach ($champion['data'] as $key => $value){
            
            $i++;
            $name_kr[]=$value['name'];
            $name_en[]=$value['id'];
            Model_character::insertCharacterList($i ,$value['id'], $value['name']);  
        };
        
    }

    //아이템 이름 가져오기
    public function all_item(Request $request)
    {        
        $item_names = array();
        $output = file_get_contents('http://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/item.json');
        $item = json_decode($output,true);

        foreach($item['data'] as $key=> $value1){
            print_r($value1);
        }

        print_r($item['data']);
    }

    //챔피언 스킬 가져오기
    public function champ_skill(Request $request)

    {   
        $result = Model_character::selectCharacterList($request->id);  
        $name = array_column($result, 'name_en');    
        foreach($name as $name_en){
            
            $output = file_get_contents("https://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/champion/$name_en.json");
            $champion_skills = json_decode($output,true);
            foreach ($champion_skills['data'] as $key => $value){
                foreach($value['spells'] as $key => $value1){
                    $champions_skill[]=$value1['name'];                      
                }
            };
                      
            Model_character::insertCharacterskill($champions_skill[0], $champions_skill[1], $champions_skill[2], $champions_skill[3]); 
            unset($champions_skill);
            
        };
    }

    public function search(Request $request)
    {
        $name_kkr = array();
        //$this->validator($request, $this->indexValidationRules);
        // echo $request['line'];
        // echo $request['champion'];
        $wherelinename = Model_character::search_champion($request['champion'], $request['line']);
        var_dump($wherelinename); 
    }


}
