<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models

class RashmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Rashmi::create([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect('/abc');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Rashmi::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Rashmi::find($id);
        $data->update(
            [
                'name' => $request->name,
                'email' => $request->email
            ]
        );
        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Rashmi::find($id);
        $data->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
