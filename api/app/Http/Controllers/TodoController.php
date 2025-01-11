<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        return response()->json(["todos" => $todos,]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "task" => "nullable|string",
        ]);
    
        $todo = Todo::create([
            "task" => $validated["task"] ?? null,
        ]);
    
        return response()->json([
            "message" => "Todo created successfully",
            "todo" => $todo,
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "task" => "nullable|string",
        ]);
    
        $todo = Todo::find($id); 

        $todo->update([
            "task" => $validated["task"] ?? $todo->task, 
        ]);
    
        return response()->json([
            "message" => "Todo created successfully",
            "todo" => $todo,
        ]);
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $todo->delete();

            return response()->json([
                "message" => "Todo deleted successfully",
            ]);
        }

        return response()->json([
            "message" => "Todo not found",
        ], 404);
    }
}
