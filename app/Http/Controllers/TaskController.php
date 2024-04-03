<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // show a task
    public function show(string $id)
    {
        $task = Task::find($id);
        return response()->json($task, 200);
    }

    // update a task
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task = Task::find($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    // delete a task
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (is_null($task)) {
            return response()->json([
                "message" => "Task not found."
            ], 404);
        }

        Task::destroy($id);

        return response()->json([
            "message" => "Task deleted successfully."
        ], 200); // if code is 204 then no content is returned "{}" 
    }
}
