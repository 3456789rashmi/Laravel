<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function func1($name){
        $name1 = $name;
        return  view('myview', compact('name1'));
    }
    public function details($id){
        $courses = [
            90 => ["C", "C++", "C#",'Perl'],
            2 => "JAVA",
            3 => "PYTHON"
        ];
        return view('course_details', compact('courses', 'id'));
    }
    public function show($name){
        return view('show', compact('name'));
    }
}
