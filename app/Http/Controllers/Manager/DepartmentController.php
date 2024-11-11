<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::withCount(['employees' => function($query){
            $query->where('users.manager_id' , auth('manager')->user()->id);
        }])->get();
        return view('manager.departments.index', compact('departments'));
    }

}
