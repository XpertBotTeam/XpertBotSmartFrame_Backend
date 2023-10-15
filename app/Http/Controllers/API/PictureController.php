<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picture;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    
    public function getAllPictures(){
        Log::info("get picturess");
      
        return Picture::all();
    }

    public function addPicture(Request $request){
        
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . "_" . trim($image->getClientOriginalName());
            // $directory = public_path('/uploads/pictures/');
            // $image->move($directory, $imageName);
            
            Storage::putFileAs('public',$image, $imageName);

            $picture = new Picture();
            $picture->picture_type = $request->picture_type;
            $picture->image_path = asset('public/storage/'.$imageName);//"/uploads/pictures/".$imageName;
            $picture->description = $request->description;
            $picture->price = $request->price;
            $picture->save();

            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Picture added successfully'
                ]
            );

        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Picture not found'
                ]
            );
        }

        
    }

    public function deletePicture($id){

        $picture = Picture::find($id);

        if (!$picture) {
            return response()->json(
                ['message' => 'Picture not found'],
                404
            );
        }

        $picture->delete();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Pictured deleted successfully'
            ]
        );
    }

    public function updatePicture(Request $request, $id){

        $picture = Picture::find($id);
        if (!$picture) {
            return response()->json(
                ['message' => 'Picture not found'],
                404
            );
        }

        if ($request->hasFile('image')) {
                        
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads\pictures'), $imageName);
            
            $picture->picture_type = $request->picture_type;
            $picture->image_path = "/uploads/pictures/".$imageName;
            $picture->description = $request->description;
            $picture->price = $request->price;
            $picture->save();

            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Pictured updated successfully'
                ]
            );
        }else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Cannot update the picture'
                ]
            );
        }

    }
}
