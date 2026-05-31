<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userfunction(){
        $name = "das";
        $users = ["das","waet","wregt"];
        return view('home',["name"=>$name],["users"=>$users]);
    }
    public function userabout(){
        return view('about');
    }
}
