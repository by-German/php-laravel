<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

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
            'description' => 'required',
            "student_id" => "required|exists:students,id",
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

    public function getTasksByStudent(string $student_id)
    {
        // query alternative
        // -----------------
        // $tasks = Task::where('student_id', $student_id)->get();
        // return response()->json($tasks, 200);

        // array alternative
        // -----------------
        // $tasks = Task::all();
        // $tasksByStudent = [];
        // foreach ($tasks as $task) {
        //     if ($task->student_id == $student_id) {
        //         array_push($tasksByStudent, $task);
        //     }
        // }
        // return response()->json($tasksByStudent, 200);

        // ORM alternative
        // ---------------
        $student = Student::find($student_id);
        $tasks = $student->tasks;
        return response()->json($tasks, 200);
    }
}
