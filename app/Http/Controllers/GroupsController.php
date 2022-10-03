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
        if( $user->id !== 1){
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
    public function editGroup(Request $request, $groupsId){
        $request->validate([
            'anonymous'=>['required'],
            'admin'=>['required'],
            'members'=>['required'],
            'staff'=>['required'],

        ]);

        $this->authorize('update',$groups);

        $groups = Groups::find($groupsId);
        if(!$groups) {
            return response() ->json([
                'success' => false,
                'message' => 'group not found'
            ]);

        }
        
       

        $groups->anonymous = $request->anonymous;
        $groups->admin = $request->admin;
        $groups->members = $request->members;
        $groups->staff = $request->staff;
        $groups->save();
        return response() ->json([
            'success' => true,
            'message' => 'groups updated'
        ]);
    }
}
