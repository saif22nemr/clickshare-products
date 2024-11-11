<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'employee_id', 'manager_id' , 'subject' , 'description' ,
        'status', // enum('new', 'in_progress', 'complete', 'canceled')
    ];

    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
    public function manager(){
        return $this->belongsTo(Manager::class , 'manager_id');
    }
}
