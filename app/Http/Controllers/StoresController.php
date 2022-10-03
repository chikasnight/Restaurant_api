<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stores;
use Illuminate\Support\Facades\Hash;


class StoresController extends Controller
{
    public function createStore(Request $request){
        //validate request body
        $request->validate([
            'fine_dinning'=>['required'],
            'fast_food'=>['required'],
            'buffet'=>['required'],
            'cafe' => ['required'],
            

          
        ]);

        $user= auth('sanctum')->user();
        if( $user->id !== 1){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        //create a stores
        $newStore = Stores::create([
            'user_id'=>auth()->id(),
            'fine_dinning'=> $request->fine_dinning,
            'fast_food'=> $request->fast_food,
            'buffet'=> $request->buffet,
            'cafe'=> $request->cafe,
            
        ]);

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a Store',
            'data' => $newStore
        ]);
    }
    public function editStore(Request $request, $storesId){
        $request->validate([
            'fine_dinning'=>['required'],
            'fast_food'=>['required'],
            'buffet'=>['required'],
            'cafe'=>['required'],

        ]);

        $this->authorize('update',$stores);

        $stores = Stores::find($storesId);
        if(!$stores) {
            return response() ->json([
                'success' => false,
                'message' => 'stores not found'
            ]);

        }
        
        

        $stores->fine_dinning = $request->fine_dinning;
        $stores->fast_food = $request->fast_food;
        $stores->buffet = $request->buffet;
        $stores->cafe = $request->cafe;
        $stores->save();
        return response() ->json([
            'success' => true,
            'message' => 'stores updated'
        ]);
    }
}
