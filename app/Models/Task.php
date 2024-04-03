<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * @ $fillable: The attributes that are mass assignable.
     * Necessary to use: Task::create($request->all());
     * 
     * if a field is not in this array, it will not be saved in the database 
     * 
     * Example 1:
     * [body/request]
     * {
     *  "name": "Task 1",
     *  "description": "Description of Task 1"
     * }
     * 
     * Example 2: the extra_field will not be saved in the database (will be ignored)
     * [body/request]
     * {
     *  "name": "Task 1",
     *  "description": "Description of Task 1",
     *  "extra_field": "Extra Field"
     * }
     * 
     * Example 3: ERROR: the title field is not in the fillable array
     * [body/request]
     * {
     *  "title": "Task 1",
     *  "description": "Description of Task 1"
     * }
     * 
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
