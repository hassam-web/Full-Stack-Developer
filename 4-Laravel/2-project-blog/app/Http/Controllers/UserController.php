<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.users.index',compact('users'));
    }
    public function destroy(Request $request,User $user)
    {
        // $user_row = User::find($user_id);
      unlink($user->user_image);
     
      $user->delete();
      return back()->with(['success' => 'user is deleted successfully !']);
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);

        $imageName = null;

        if ($request->user_image) {
            $imageName = "user_images/" .time().'.'.$request->user_image->extension();  
            $request->user_image->move(public_path('user_images'), $imageName);
        }


        User::create([
          "username" => $request->username,
          "user_firstname" => $request->user_firstname,
          "user_lastname" => $request->user_lastname,
          "email" => $request->email,
          "password" => Hash::make($request->password),
          "user_role" => $request->user_role,
          "user_image" => $imageName
        ]);

        return back()->with(['success' => 'user created successfully']);
    }
    public function user_edit(Request $request,User $user)
    {
        return view('admin.users.edit',compact('user'));
    }
    public function user_update(Request $request,User $user)
    {
        $request->validate([
            'username' => 'required',
            // 'password' => 'required',
            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);

        $imageName = $user->user_image;

        if ($request->user_image) {
            //delete previos image
            unlink($user->user_image);
            //then upload new image and update imageName variable
            $imageName = "user_images/" .time().'.'.$request->user_image->extension();  
            $request->user_image->move(public_path('user_images'), $imageName);
        }

        $updatedPassword = $user->password;
        if ($request->password) {
            $updatedPassword = Hash::make($request->password);
        }


        $user->update([
          "username" => $request->username,
          "user_firstname" => $request->user_firstname,
          "user_lastname" => $request->user_lastname,
          "email" => $request->email,
          "password" => $updatedPassword,
          "user_role" => $request->user_role,
          "user_image" => $imageName
        ]);

        return back()->with(['success' => 'user updated successfully']);
    }
}