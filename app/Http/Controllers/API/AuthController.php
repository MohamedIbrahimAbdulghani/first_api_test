<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;
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
            return $this->ApiResponse(null, $validator->errors(), 404);
        else:
            $user = User::create($request->all());
        endif;
        if($user):
            return $this->ApiResponse(new AuthResource($user), 'User Successfully Registered', 200);
        endif;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()):
            return $this->ApiResponse(null, $validator->errors(), 404);
        endif;
        if(!$token = auth()->attempt($validator->validated())):
            return response()->json(['error' => 'Unauthorized'], 401);
        endif;
        return $this->createNewToken($validator);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function createNewToken($validator) {
        return response()->json([
            'access_token' => $validator,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


}