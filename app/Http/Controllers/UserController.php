<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return view('user.user-list',compact('users'));
    }

    public function makeAdmin(Request $request){
        $currentUser = User::find($request->id);
        if ($currentUser->role){
            $currentUser->role = '0';
            $currentUser->update();
        }
        return redirect()->back()->with('message',['icon'=>'success','title'=>$currentUser->name.' is Admin Now']);
    }

}
