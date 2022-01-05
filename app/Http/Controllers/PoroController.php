<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
// use Illuminate\Validation\Validator;

class PoroController extends Controller
{
    protected $validationRules=[
        'title' => 'required|unique|max:255',
        'body' => 'required',
    ];

    public function test (Request $request) {
        $v = Validator::make($request->all(), $this->validationRules);
    
        if ($v->fails())
        {
            return $v->errors();
        }
     
        return response("zzzzz", 201);
    }

}
