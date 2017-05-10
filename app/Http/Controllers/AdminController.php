<?php

namespace App\Http\Controllers;
use App\Client;
use App\UserComplaint;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function get_all_complaints(){
        $complaints=UserComplaint::get();
        return view('admin.view_user_complaints')->with('complaints',$complaints);
    }

    public function manage_users(){
        $users=User::get();
        return view('admin.manage_users')->with('users',$users);
    }

    public function get_edit_user(Request $request){
        $user=User::where('id',$request->id)->get()->first();
        return view('auth.register')->with('edit',true)->with('admin',true)->with('user',$user);
    }
    
    public function edit_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user=User::where('id',$request->id)->get()->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->type=$request->type;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->route('manage_users');
    }

    public function delete_user(Request $request){
        $user=User::where('id',$request->id)->get()->first();
        $user->delete();
        return redirect()->route('manage_users');
    }

    public function add_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->type=$request->type;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->route('manage_users');
    }

    public function get_add_user(){
        return view('auth.register')->with('admin',true);
    }

    public function get_add_collection_point(){
        $users=User::where('type',"USER")->get();
        return view('admin.add_collection_point')->with('users',$users);
    }

    public function add_collection_point(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email|max:255|exists:users,email',
            'address' => 'required|string|min:6',
            'lat_in' => 'required|string',
            'lng_in' => 'required|string',
        ]);
        $client=new Client();
        $user=User::where('email',$request->email)->first();
        $client->user_id=$user->id;
        $client->address=$request->address;
        $client->lat_in=$request->lat_in;
        $client->lng_in=$request->lng_in;
        $client->save();
        return redirect()->route('home');
    }
}
