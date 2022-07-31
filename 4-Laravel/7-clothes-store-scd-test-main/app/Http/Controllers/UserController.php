<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
    	// dd('working');
    	$users = User::get();
    	return view('admin.users.index')->with(['users' => $users]);
    }
	}
