<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\TaskRequest;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = auth('employee')->user();
        $tasks = Task::where('employee_id', $employee->id)->orderByDesc('created_at')->get();
        return view('employee.tasks.index', compact('tasks'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('employee.tasks.edit', compact( 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->only(['subject', 'description']   );
        $task->update($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('employee.task.index'));
    }



    public function updateStatus(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer|exists:tasks,id,employee_id,' . auth('employee')->id(),
            'status' => 'required|in:in_progress,complete,canceled',
        ]);
        $task = Task::find($request->task_id);
        $task->update([
            'status' => $request->status
        ]);
        return $this->successResponse(message: trans('app.save_success'));
    }
}
