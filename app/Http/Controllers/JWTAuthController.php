<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Model_user;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use App\Models\User;
class JWTAuthController extends Controller
{
    protected $register_post=[
        // 'nickname' => 'required|string|max:50',
        // 'email' => 'required|email|max:100',
        // 'password' => 'required|string|min:8|max:100',
        // 'password_confirmation' => 'required|string|min:8|max:100',
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8|max:255|confirmed',
        'password_confirmation' => 'required|string|min:8|max:255',
    ];
    protected $login_post=[
        'email' => 'required|email|max:100',
        'password' => 'required|string|min:8|max:100',
    ];

    public function register_post(Request $request) {
        $this->validator($request, $this->register_post);
        // $isExistEmail = Model_user::checkUniqueEmail($request->email);
        // $isExistnickname = Model_user::checkUniqueEmail($request->nickname);
        // if (!empty($isExistEmail) || !empty($isExistnickname)) throw new CustomException('이메일 또는 닉네임이 중복');
        // $user = Model_user::insertUser($request->email, $request->nickname, bcrypt($request->password));

        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function login_post(Request $request) {
        $this->validator($request, $this->login_post);
        var_dump(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
        if (! $token = Auth::guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',   
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function user() {
        return response()->json(Auth::guard('api')->user());
    }
    
}


