<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function addFeedback(Request $request){

        $user = Auth::user();
        $feedback = new Feedback();
        $feedback->user_id = $user->id;
        $feedback->comment = $request->comment;
        $feedback->save();
        
        return response()->json(
            [
                'success'=>true,
                'message'=>'Feedback added successfully'
            ]
        );
    }

    public function getFeedbacks(){
        $feedbacks =  Feedback::all();

        foreach($feedbacks as $fb){
            $user_full_name = strtoupper(User::where('id','=',$fb->user_id)->first()->first_name) ." ". strtoupper(User::where('id','=',$fb->user_id)->first()->last_name);
            $fb->full_name = $user_full_name;
        }

        return response()->json($feedbacks);
    }
}
