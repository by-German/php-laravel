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
        'description',
        'student_id' // student_id is necessary to create a task
    ];

    /**
     * @ $hidden: The attributes that should be hidden for arrays.
     * 
     * [response without hidden fields]
     * {
     *  "id": 1,
     *  "name": "Task 1",
     *  "description": "Description of Task 1",
     *  "created_at": "2021-09-01T00:00:00.000000Z",
     *  "updated_at": "2021-09-01T00:00:00.000000Z"
     * }
     * 
     * the created_at and updated_at fields will be hidden
     * [response with hidden fields]
     * {
     *  "id": 1,
     *  "name": "Task 1",
     *  "description": "Description of Task 1"
     * }
     * 
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
