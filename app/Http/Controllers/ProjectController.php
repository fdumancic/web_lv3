<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth.basic');
    }

	public function store(Request $request)
	    {

	    	if (Auth::check()) {
		        $project = new Project;
		        $project->voditelj_id = Auth::id();
		        $project->naziv_projekta = $request->input('naziv_projekta');
		        $project->opis_projekta = $request->input('opis_projekta');
		        $project->cijena_projekta = $request->input('cijena_projekta');
		        $project->obavljeni_poslovi = $request->input('obavljeni_poslovi');
		        $project->datum_pocetka = $request->input('datum_pocetka');
		        $project->datum_zavrsetka = $request->input('datum_zavrsetka');
		        $users = $request->input('korisnici_projekta');
		        $vod_id = Auth::id();
		        $users = $users.','.$vod_id;

		        //add users to project

		        $users = explode(',', $users);
		        $user_count = count($users);
		        $number_of_users = User::whereIn('id', $users)->get()->count();

		        if($number_of_users == $user_count){
		            $project->save();
		            $project->users()->attach($users);
		        }
		        return 'stored';
		    }
	    }

	public function update(Request $request, $id)
	 	{

	    	if (Auth::check()) {
		        $project = Project::find($id);
		        if($project->voditelj_id == Auth::id()){
			        $project->naziv_projekta = $request->input('naziv_projekta');
			        $project->opis_projekta = $request->input('opis_projekta');
			        $project->cijena_projekta = $request->input('cijena_projekta');
			        $project->obavljeni_poslovi = $request->input('obavljeni_poslovi');
			        $project->datum_pocetka = $request->input('datum_pocetka');
			        $project->datum_zavrsetka = $request->input('datum_zavrsetka');
			        $users = $request->input('korisnici_projekta');
			        $vod_id = Auth::id();
			        $users = $users.','.$vod_id;

			        //add users to project

			        $users = explode(',', $users);
			        $user_count = count($users);
			        $number_of_users = User::whereIn('id', $users)->get()->count();

			        if($number_of_users == $user_count){
			            $project->save();
			            $project->users()->sync($users);
			        }
			     }
			    if($project->voditelj_id != Auth::id()){
			    	$project->obavljeni_poslovi = $request->input('obavljeni_poslovi');
			    	$project->save();
			    }
		    return 'updated';
		    }

	    }
}