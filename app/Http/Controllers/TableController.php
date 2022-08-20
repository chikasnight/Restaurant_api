<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\Hash;


class TableController extends Controller
{
    public function createTable(Request $request){
        //validate request body
        $request->validate([
            'table_1'=>['required'],
            'table_2'=>['required'],
            'table_3'=>['required'],
            'table_4'=>['required'],
            'table_5'=>['required'],
            'table_6'=>['required'],
            'table_7'=>['required'],
          
        ]);

        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        //create a Tables
        $newTable = Table::create([
            'user_id'=> auth()->id(),
            'table_1'=> $request->table_1,
            'table_2'=> $request->table_2,
            'table_3'=> $request->table_3,
            'table_4'=> $request->table_4,
            'table_5'=> $request->table_5,
            'table_6'=> $request->table_6,
            'table_7'=> $request->table_7,

        ]);

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a Table',
            'data' => $newTable
        ]);
    }
    public function editTable(Request $request, $userId){
        $request->validate([
            'table_1'=>['required'],
            'table_2'=>['required'],
            'table_3'=>['required'],
            'table_4'=>['required'],
            'table_5'=>['required'],
            'table_6'=>['required'],
            'table_7'=>['required'],
        ]);
        
        $table = Table::find($tableId);
        if(!$table) {
            return response() ->json([
                'success' => false,
                'message' => 'table not found'
            ]);

        }
        
        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        $table->table_1 = $request->table_1;
        $table->table_2 = $request->table_2;
        $table->table_3 = $request->table_3;
        $table->table_4 = $request->table_4;
        $table->table_5 = $request->table_5;
        $table->table_6 = $request->table_6;
        $table->table_7 = $request->table_7;
        $table->save();
        return response() ->json([
            'success' => true,
            'message' => 'table updated'
        ]);
    }
}
