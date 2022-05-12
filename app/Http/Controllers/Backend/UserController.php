<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function UserView(){
        $data['users'] = User::all();
        return view('backend.user.index', $data);
    }

    public function UserCreate(){
        return view('backend.user.create');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();

        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
    		'message' => 'User Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('users.view')->with($notification);


    }

    public function UserEdit($id){
    	$editData = User::find($id);
    	return view('backend.user.edit',compact('editData'));

    }

    public function UserUpdate(Request $request, $id){

    	$data = User::find($id);
    	$data->name = $request->name;
    	$data->email = $request->email;
        $data->usertype = $request->usertype;
    	$data->save();

    	$notification = array(
    		'message' => 'User Updated Successfully',
    		'alert-type' => 'info'
    	);

    	return redirect()->route('users.view')->with($notification);

    }

    public function UserDelete($id){
    	$user = User::find($id);
    	$user->delete();

    	$notification = array(
    		'message' => 'User Deleted Successfully',
    		'alert-type' => 'info'
    	);

    	return redirect()->route('users.view')->with($notification);

    }
}
