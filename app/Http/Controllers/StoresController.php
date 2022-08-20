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
        if( !Hash::check( $user->id(), 1)){
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
    public function editStore(Request $request, $userId){
        $request->validate([
            'fine_dinning'=>['required'],
            'fast_food'=>['required'],
            'buffet'=>['required'],
            'cafe'=>['required'],

        ]);
        
        $store = Stores::find($storeId);
        if(!$store) {
            return response() ->json([
                'success' => false,
                'message' => 'store not found'
            ]);

        }
        
        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        $store->fine_dinning = $request->fine_dinning;
        $store->fast_food = $request->fast_food;
        $store->buffet = $request->buffet;
        $store->cafe = $request->cafe;
        $store->save();
        return response() ->json([
            'success' => true,
            'message' => 'store updated'
        ]);
    }
}
