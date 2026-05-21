<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EI; //mandatory import for model

class EIcontroller extends Controller
{
    public function index(){
        $data=EI::all();
        return view('read',compact('data'));
    }
    public function create(){
        return view('studentform');
    }
    public function store(Request $request){
        EI::create([
        'name'=>$request->name,
        'email'=>$request->email
        ]);
        return redirect('/abc');
    }
    public function edit($id){
        $data=EI::find($id);
        return view('edit',compact('data'));
    }
    public function update(Request $request,$id){
        $data=EI::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();
        return redirect('/abc');    
    }
    public function destroy($id){
        $data=EI::find($id);
        $data->delete();
        return redirect('/abc');
    }
}
