<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Model_user;
use App\Exceptions\CustomException;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class JWTAuthController extends Controller
{
    protected $indexValidationRules=[
        'nickname' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'password' => 'required|string|min:8|max:100|confirmed',
        'password_confirmation' => 'required|string|min:8|max:100',
    ];

    public function register_post(Request $request) {
        $this->validator($request, $this->indexValidationRules);
        $isExistEmail = Model_user::checkUniqueEmail($request->email);
        $isExistnickname = Model_user::checkUniqueEmail($request->nickname);
        if (!empty($isExistEmail) || !empty($isExistnickname)) throw new CustomException('이메일 또는 닉네임이 중복');
        $user = Model_user::insertUser($request->email, $request->nickname, bcrypt($request->password));

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }
}


