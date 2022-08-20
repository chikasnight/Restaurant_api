<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Hash;

class GroupsController extends Controller
{
    public function createGroup(Request $request){
        //validate request body
        $request->validate([
            'anonymous'=>['required'],
            'admin'=>['required'],
            'members'=>['required'],
            'staff' => ['required'],
            

          
        ]);

        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        //create a groups
        $newGroup = Groups::create([
            'user_id'=>auth()->id(),
            'anonymous'=> $request->anonymous,
            'admin'=> $request->admin,
            'members'=> $request->members,
            'staff'=> $request->staff,
            
        ]);

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a Group',
            'data' => $newGroup
        ]);
    }
    public function editGroup(Request $request, $userId){
        $request->validate([
            'anonymous'=>['required'],
            'admin'=>['required'],
            'members'=>['required'],
            'staff'=>['required'],

        ]);
        
        $group = Groups::find($groupId);
        if(!$group) {
            return response() ->json([
                'success' => false,
                'message' => 'group not found'
            ]);

        }
        
        $user= auth('sanctum')->user();
        if( !Hash::check( $user->id(), 1)){
            return response()->json([
                'success'=> false,
                'message'=>'This User is not Authorized',
                
            ]);

        }

        $group->anonymous = $request->anonymous;
        $group->admin = $request->admin;
        $group->members = $request->members;
        $group->staff = $request->staff;
        $group->save();
        return response() ->json([
            'success' => true,
            'message' => 'group updated'
        ]);
    }
}
