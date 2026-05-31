<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rashmi;

class RashmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rashmi::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'count' => count($data)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        $data = Rashmi::create($validated);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Rashmi::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Rashmi::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email'
        ]);
        
        $data->update($validated);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Rashmi::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found'
            ], 404);
        }
        
        $data->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully'
        ]);
    }
}
