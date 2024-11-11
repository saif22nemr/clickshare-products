<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'name'
    ];

    public function employees(){
        return $this->belongsToMany(Employee::class , 'user_departments' , 'department_id' , 'user_id');
    }
    public function users(){
        return $this->belongsToMany(User::class , 'user_departments' , 'department_id' , 'user_id');
    }
}
