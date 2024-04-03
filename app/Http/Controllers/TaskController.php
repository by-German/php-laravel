<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // show all tasks
    public function index()
    {
        return response()->json(['message' => 'Get all tasks'], 200);
    }

}
