<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gender', 'department', 'education', 'salary', 'hobbies', 'dob'];

    protected $casts = [
        'hobbies' => 'array'
    ];
}
