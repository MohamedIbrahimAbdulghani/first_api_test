<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'name'=>'required|string|between:2, 100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string|min:6',
        ]);
        if($validator->fails()):
            return response()->json($validator->errors()->toJson(), 422);
        endif;

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User Successfully Registered',
            'user' => $user ], 201
        );
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email'=>'required|email',
        'password'=>'required|string|min:6',
    ]);
    if($validator->fails()):
        return response()->json($validator->errors(), 422);
    endif;


        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}