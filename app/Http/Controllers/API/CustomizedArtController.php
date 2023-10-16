<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomizedArt;
use Illuminate\Support\Facades\Log;

class CustomizedArtController extends Controller
{
    public function getAllCustomizedArts(){
        return CustomizedArt::all();
    }

    public function addCustomizedArt(Request $request){
        
        $customizedArt = new CustomizedArt();

        $price = 0;

        if($request->frame_id != null && !empty($request->frame_id)){
            $frame = Frames::find($request->frame_id);
            if($frame){
                $customizedArt->frame_id = $request->frame_id;
                $price += $frame->price;
            }else{
                $customizedArt->frame_id = -1;
            }
        }else{
            $customizedArt->frame_id = -1;
        }

        if($request->picture_id != null && !empty($request->picture_id)){
            $picture = Picture::find($request->picture_id);
            if($picture){
                $customizedArt->picture_id = $request->picture_id;
                $price += $picture->price;
            }else{
                $customizedArt->picture_id = -1;
            }
        }else{
            $customizedArt->picture_id = -1;
        }

        if($request->order_id != null && !empty($request->order_id)){
            $order = Order::find($request->order_id);
            if($order){
                $customizedArt->order_id = $request->order_id;
            }else{
                $customizedArt->order_id = -1;
                return response()->json(
                    [
                        'success'=>false,
                        'message'=>"Order doesn't exist"
                    ]
                );
            }
        }else{
            $customizedArt->order_id = -1;
            return response()->json(
                [
                    'success'=>false,
                    'message'=>"Order doesn't exist"
                ]
            );
        }

        $customizedArt->width = $request->width;
        $customizedArt->height = $request->height;
        $customizedArt->background_size = $request->background_size;
        $customizedArt->price = $price;
        
        if( ($request->frame_id != null && !empty($request->frame_id)) ||
            ($request->picture_id != null && !empty($request->picture_id))
          ){            
            $customizedArt->save();
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'CustomizedArtd added successfully'
                ]
            );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'CustomizedArtd should contain a picture or a frame'
                ]
            );
        }

        
    }

    public function deleteCustomizedArt($id){

        $customizedArt = CustomizedArt::find($id);

        if (!$customizedArt) {
            return response()->json(
                ['message' => 'CustomizedArt not found'],
                404
            );
        }

        $customizedArt->delete();
        return response()->json(
            [
                'success'=>true,
                'message'=>'CustomizedArtd deleted successfully'
            ]
        );
    }

    public function updateCustomizedArt(Request $request, $id){

        $customizedArt = CustomizedArt::find($id);
        if (!$customizedArt) {
            return response()->json(
                ['message' => 'CustomizedArt not found'],
                404
            );
        }

        $price = 0;

        if($request->frame_id != null && !empty($request->frame_id)){
            $frame = Frames::find($request->frame_id);
            if($frame){
                $customizedArt->frame_id = $request->frame_id;
                $price += $frame->price;
            }else{
                $customizedArt->frame_id = -1;
            }
        }else{
            $customizedArt->frame_id = -1;
        }

        if($request->picture_id != null && !empty($request->picture_id)){
            $picture = Picture::find($request->picture_id);
            if($picture){
                $customizedArt->picture_id = $request->picture_id;
                $price += $picture->price;
            }else{
                $customizedArt->picture_id = -1;
            }
        }else{
            $customizedArt->picture_id = -1;
        }

        if($request->order_id != null && !empty($request->order_id)){
            $order = Order::find($request->order_id);
            if($order){
                $customizedArt->order_id = $request->order_id;
            }else{
                $customizedArt->order_id = -1;
                return response()->json(
                    [
                        'success'=>false,
                        'message'=>"Order doesn't exist"
                    ]
                );
            }
        }else{
            $customizedArt->order_id = -1;
            return response()->json(
                [
                    'success'=>false,
                    'message'=>"Order doesn't exist"
                ]
            );
        }

        if(!empty($request->width) && $request->width != null){
            $customizedArt->width = $request->width;
        }
        if(!empty($request->height) && $request->height != null){
            $customizedArt->height = $request->height;
        }
        if(!empty($request->background_size) && $request->background_size != null){
            $customizedArt->background_size = $request->background_size;
        }
        
        $customizedArt->price = $price;
        
        if( ($request->frame_id != null && !empty($request->frame_id)) ||
            ($request->picture_id != null && !empty($request->picture_id))
          ){            
            $customizedArt->save();
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'CustomizedArtd added successfully'
                ]
            );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'CustomizedArtd should contain a picture or a frame'
                ]
            );
        }

    }
}
