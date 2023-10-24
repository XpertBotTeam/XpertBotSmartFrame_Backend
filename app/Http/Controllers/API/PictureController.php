<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Picture;
use App\Models\Lookup;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    
    public function getAllPictures(){

        $pictures = Picture::all();

        foreach($pictures as $pic){
            
            $type = Lookup::where('display_name','=','picture_type')
                        ->where('code','=',$pic->picture_type)
                        ->value('value');
            
            $pic->picture_type = $type;
        }

        return $pictures;
    }

    public function addPicture(Request $request){
        
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . "_" . trim($image->getClientOriginalName());
            Storage::putFileAs('public',$image, $imageName);

            $picture = new Picture();
            $picture->picture_type = $request->picture_type;
            $picture->image_path = asset('storage/'.$imageName);
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

    public function getPictureById($id){
        $picture = Picture::find($id);
        if($picture){
            return response()->json($picture);
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
            $imageName = time() . "_" . trim($image->getClientOriginalName());
            Storage::putFileAs('public',$image, $imageName);
            
            $picture->image_path = asset('storage/'.$imageName);
            
        }

        if(!empty($request->picture_type)){
            $picture->picture_type = $request->picture_type;
        }
        if(!empty($request->description)){
            $picture->description = $request->description;
        }
        if(!empty($request->price)){
            $picture->price = $request->price;
        }
        
        $picture->save();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Pictured updated successfully'
            ]
        );
    }

    public function getPictureTypes(){

        $types = Lookup::where('display_name','=','picture_type')->get();
        return response()->json($types);

    }
}
