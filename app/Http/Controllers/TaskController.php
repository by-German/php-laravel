<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // show all tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    public function store(Request $request)
    {   
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->save();

        return response()->json($task, 201);
    }

}
