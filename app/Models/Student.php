<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    /**
     * This is a MUTATOR, a method that allows you to manipulate the data 
     * of a model attribute when you set its value.
     * 
     * That is called automatically when you set the value of the password attribute.
     * For this reason, for example, when you create a new student, this method is called.
     * 
     * The CONVENTION to define a mutator is to use the set{AttributeName}Attribute method.
     * 
     * This mutator is used to encrypt the password before saving it to the database.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
}
