<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home(){
    	$questtypes = \DB::table('questtype')->get();
    	return view('home', ['questtypes' => $questtypes]);
    }
}
