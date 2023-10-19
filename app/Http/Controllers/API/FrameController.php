<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frames;
use App\Models\Lookup;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FrameController extends Controller
{
    public function getAllFrames(){
        // return Frames::all();

        $frames = Frames::all();

        foreach($frames as $frame){
            
            $type = Lookup::where('display_name','=','frame_type')
                          ->where('code','=',$frame->frame_type)
                          ->value('value');
            
            $frame->frame_type = $type;
        }

        // return $frames; 
        return response()->json($frames);
    }

    public function getFrameById($id){
        $frame = Frames::find($id);
        if($frame){
            return response()->json($frame);
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Frame not found'
                ]
            );
        }
    }

    public function addFrame(Request $request){
        
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . "_" . trim($image->getClientOriginalName());
            Storage::putFileAs('public',$image, $imageName);
            
            $frame = new Frames();
            $frame->frame_type = $request->frame_type;
            $frame->image_path = asset('storage/'.$imageName);
            $frame->description = $request->description;
            $frame->price = $request->price;
            $frame->save();

            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Frame added successfully'
                ]
            );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Frame not found'
                ]
            );
        }
    }

    public function deleteFrame($id){

        $frame = Frames::find($id);

        if (!$frame) {
            return response()->json(
                ['message' => 'Frame not found'],
                404
            );
        }

        $frame->delete();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Frame deleted successfully'
            ]
        );
    }

    public function updateFrame(Request $request, $id){

        $frame = Frames::find($id);
        if (!$frame) {
            return response()->json(
                ['message' => 'Frames not found'],
                404
            );
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . "_" . trim($image->getClientOriginalName());
            Storage::putFileAs('public',$image, $imageName);
            $frame->image_path = asset('storage/'.$imageName);
        }

        if(!empty($request->frame_type)){
            $frame->frame_type = $request->frame_type;
        }
        if(!empty($request->description)){
            $frame->description = $request->description;
        }
        if(!empty($request->price)){
            $frame->price = $request->price;
        }
        
        $frame->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Frame updated successfully'
            ]
        );
    }

    public function getFrameTypes(){

        $types = Lookup::where('display_name','=','frame_type')->get();
        return response()->json($types);

    }
}
