<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:employee');
    }
    public function index(){
        $employee = auth('employee')->user();
        $data = [
            'tasks_count' => Task::where('employee_id' , $employee->id)->count(),
            'tasks_in_progress_count' => Task::where('employee_id' , $employee->id)->where('status' , 'in_progress')->count(),
            'tasks_new_count' => Task::where('employee_id' , $employee->id)->where('status' , 'new')->count(),
            'tasks_complete_count' => Task::where('employee_id' , $employee->id)->where('status' , 'complete')->count(),
            'tasks_canceled_count' => Task::where('employee_id' , $employee->id)->where('status' , 'canceled')->count(),
        ];
        return view('employee.home' , compact('data'));
    }
}
