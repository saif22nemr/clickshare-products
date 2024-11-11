<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
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
        $manager = auth('manager')->user();
        $tasks = Task::where('manager_id', $manager->id)->orderByDesc('created_at')->get();
        return view('manager.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('manager_id', auth('manager')->Id())->get();
        return view('manager.tasks.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        // validate password
        $data = $request->validated();
        $user = auth('manager')->user();
        $data += [
            'manager_id' => $user->id,
            'status' => 'new'
        ];
        $task = Task::create($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('manager.task.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

        $employees = Employee::where('manager_id', auth('manager')->Id())->get();
        return view('manager.tasks.edit', compact('employees', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('manager.task.index'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->manager_id != auth('manager')->user()->id):
            return $this->errorResponse(trans('app.error_not_found'));
        endif;
        $task->delete();
        return $this->successResponse(message: trans('app.delete_success'));
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer|exists:tasks,id,manager_id,' . auth('manager')->id(),
            'status' => 'required|in:in_progress,complete,canceled',
        ]);
        $task = Task::find($request->task_id);
        $task->update([
            'status' => $request->status
        ]);
        return $this->successResponse(message: trans('app.save_success'));
    }
}
