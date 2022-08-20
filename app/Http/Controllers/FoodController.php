<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Jobs\UploadImage;
use Illuminate\Support\Facades\Hash;



class FoodController extends Controller
{
    public function createFood(Request $request){
        //validate request body
        $request->validate([
            'name'=>['required'],
            'price'=>['required'],
            'description'=>['required'],
            'image' => ['mimes:png,jpeg,gif,bmp', 'max:2048','required'],
            

          
        ]);

        
        //get the image
        $image = $request->file('image');
        //$image_path = $image->getPathName();
 
        // get original file name and replace any spaces with _
        // example: ofiice card.png = timestamp()_office_card.pnp
        $filename = time()."_".preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
 
        // move image to temp location (tmp disk)
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');
 
        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        //create a groups
        $newFood = Food::create([
            'user_id'=>auth()->id(),
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image'=> $filename,
            'disk'=> config('site.upload_disk'),

        ]);

        //dispacth job to handle image manipulation
        $this->dispatch(new UploadImage($newfood));


        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a food',
            'data' => $newFood
        ]);
    }
    public function editfood(Request $request, $userId){
        $request->validate([
            'price'=>['required'],
            'description'=>['required'],
            'image' => ['mimes:png,jpeg,gif,bmp', 'max:2048','required'],
            
        ]);
        
        $food = Food::find($foodId);
        if(!$food) {
            return response() ->json([
                'success' => false,
                'message' => 'food not found'
            ]);

        }
        
        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        $food->price = $request->price;
        $food->description = $request->description;
        $food->image = $request->image;
        $food->save();
        return response() ->json([
            'success' => true,
            'message' => 'food updated'
        ]);
    }
    public function deleteFood( $foodId){

        $food = Food::find($foodId);
        if(!$food) {
            return response() ->json([
                'success' => false,
                'message' => 'food not found'
            ]);
        }

        

        $this->authorize('delete',$food);
        //delete food
        $food-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'food deleted'
            ]); 
    }
}
