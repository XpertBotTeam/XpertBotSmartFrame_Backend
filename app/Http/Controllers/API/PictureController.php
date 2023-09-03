<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picture;
use Illuminate\Support\Facades\Log;

class PictureController extends Controller
{
    
    public function getAllPictures(){
        return Picture::all();
    }

    public function addPicture(Request $request){
        
        Log::info("addPicture");
      
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $attachment = time() . "_" . trim($file->getClientOriginalName());
        //     $dirProd = public_path('/uploads/seeker_jobs/');
        //     $file->move($dirProd, $atachment);
        // }

        $picture = new Picture();
        $picture->picture_type = $request->picture_type;
        $picture->image_path = "p/kk";
        $picture->description = $request->description;
        $picture->price = $request->price;
        $picture->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Pictured added successfully'
            ]
            );
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


        // if ($request->hasFile('file')) {
        //     // if ($picture->image_path) {
        //     //     Storage::delete($picture->image_path);
        //     // }
        //     // $data['image_path'] = $request->file('file')->store('uploads');
        // }

        $picture->picture_type = $request->picture_type;
        $picture->image_path = "uppp";
        $picture->description = $request->description;
        $picture->price = $request->price;
        $picture->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Pictured updated successfully'
            ]
        );
    }
}
