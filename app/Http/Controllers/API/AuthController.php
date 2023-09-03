<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request){
    
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $access_token = $user->createToken('authToken')->plainTextToken;
            return response()->json(
                [
                    'success'=>true,
                    'token'=>$access_token,
                    'message'=>'User logged in successfully'
                ]
                );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Wrong username or password'
                ]
                );
        }
    }


    public function register(Request $request){

        $user = User::where('email', $request->email)->first();

        if(is_null($user))
        {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user_role = 1;
            $user->save();

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(
                [
                    'status'=>true,
                    'message'=>'User Created Succesfully',
                    'token' => $token
                ]
                );
        }else{
            return response()->json(
                [
                    'status'=>false,
                    'message'=>'User already exists',
                    
                ]
                );
        }
    }
}
