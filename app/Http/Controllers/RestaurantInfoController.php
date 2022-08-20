<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestaurantInfo;
use Illuminate\Support\Facades\Hash;

class RestaurantInfoController extends Controller
{
    public function info(Request $request){
        //validate request body
        $request->validate([
            'name'=>['required'],
            'address'=>['required'],
            'country'=>['required'],
            'description' => ['required'],
            

          
        ]);

        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        //create a info
        $info = RestaurantInfo::create([
            'user_id'=>auth()->id(),
            'name'=> $request->name,
            'address'=> $request->address,
            'country'=> $request->country,
            'description'=> $request->description,
            
        ]);

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created an information',
            'data' => $info
        ]);
    }
    public function getInfo(Request $request, $restaurantInfoId){
        $restaurantInfo = RestaurantInfo::find($restaurantInfoId);
        if(!$restaurantInfo) {
            return response() ->json([
                'success' => false,
                'message' => 'restaurantInfo not found'
            ]);
        }

        return response() ->json([
            'success'=> true,
            'message'  => 'restaurantInfo found',
            'data'   => [
                'restaurantInfo'=> $restaurantInfo,
                
            ]
        ]);
    }
   
}
