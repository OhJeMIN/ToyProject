<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_character;

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

        //이미지 주소
        //https://ddragon.leagueoflegends.com/cdn/12.1.1/img/champion/Jinx.png
        $output = file_get_contents('https://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/champion.json');
        $champion = json_decode($output,true);
        foreach ($champion['data'] as $key => $value){
            $name_kr[]=$value['name'];
            $name_en[]=$value['id'];
            // echo $value['name'];
            // echo $value['id'];
            // echo "<br>"; 
            Model_character::insertCharacterList($value['id'], $value['name']);  
        };
        
        
        
        // $name = $data1->data;
        // foreach($data1 as $name){
        //     foreach($name as $id){
        //         echo $name->id;
        //     }
            
        // }
        // var_dump($data);
        // print_r($data1["data"]);
        // echo($data1-> data);
        // return $data['id'];
        // return $output;
        // echo $data[0]->data;
    }

    //아이템 이름 가져오기
    public function all_item(Request $request)
    {        
        $item_names = array();
        $output = file_get_contents('http://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/item.json');
        $item = json_decode($output,true);
        foreach ($item['data'] as $key => $value){
            echo $value['name'];
            $item_names=$value['name'];
            echo "<br>";
        };
    }

    //챔피언 스킬 가져오기
    public function champ_skill(Request $requset)
    {
        
        $$chapmions_skill = array();
        // for($i = 0; $i< count($character_names); $i++){

        // }
        $output = file_get_contents('https://ddragon.leagueoflegends.com/cdn/12.1.1/data/ko_KR/champion/Aatrox.json');
        $champion_skills = json_decode($output,true);
        foreach ($champion_skills['data'] as $key => $value){
            foreach($value['spells'] as $key => $value1){
                echo $value1['name'];
                $chapmions_skill=$value['spells'];
                echo "<br>";
            }
        };
    }
}
