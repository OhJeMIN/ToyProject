<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Model_character;

function validator($request, $validationRules)
{
    $v = Validator::make($request->all(), $validationRules);
    if ($v->fails()) {
        return $v->errors();
    }
}

class PoroController extends Controller
{
    protected $indexValidationRules=[
        'id' => 'required|integer'
    ];
    protected $listValidationRules=[
    ];

    public function index_get(Request $request)
    {
        validator($request, $this->indexValidationRules);
        $character = Model_character::getCharacter($request->id);
        return $character;
    }

    public function list_get(Request $request)
    {
        $character_list = array();

        validator($request, $this->listValidationRules);

        $result = Model_character::getCharacterList($request->id);
        foreach($result as $character) {
            $character_list[] = array(
                'id' => $character->no,
                'name' => $character->name,
                'line' => $character->line
            );
        }
        return $character_list;
    }
}
