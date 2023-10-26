<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lookup;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request){

        Log::info($request);
    
        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $access_token =  $user->createToken('MyApp')->accessToken;;

            Log::info("token....... ".$access_token);
            $user->save();

            $user_role = Lookup::where('code','=',$user->user_role)->where('display_name','=','user_role')->first()->value;

            return response()->json(
                [
                    'success'=>true,
                    'token'=>$access_token,
                    'first_name'=>$user->first_name,
                    'last_name'=>$user->last_name,
                    'user_role'=>$user_role,
                    'message'=>'User logged in successfully'
                ]
                );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Wrong email or password'
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

    public function logout(Request $request){

        $user = Auth::user();
        Log::info($user);
        $user->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);

    }
}
