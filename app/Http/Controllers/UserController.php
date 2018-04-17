<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth.basic');
    }

    public function read()
    {
      $data = User::get();
		  return $data;
    }


  	public function showMyProjects()
    {
      $id = Auth::id();
      $data = User::find($id)
        ->projects()
        ->where([
            ['user_id', '=', $id],
        ])
        ->orderBy('id')
        ->get();
      return $data;
    }

    public function showUserProjects($id)
    {
      $data = User::find($id)
        ->projects()
        ->where([
            ['user_id', '=', $id],
        ])
        ->orderBy('id')
        ->get();
      return $data;
    }


}