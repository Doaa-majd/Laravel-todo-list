<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::get();

        return view('index')->with('tasks',$tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'status' => 'required|numeric'
        ]);
       $task= Task::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json(['success'=>"Task created successfully.", 'task' => $task]);

    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => $request->status]);
        
        return response()->json(['success'=>"Task updated successfully."]);

    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['success'=>"Task updated successfully."]);

    }
}
