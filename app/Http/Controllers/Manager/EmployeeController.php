<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
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
        $employees = Employee::where('manager_id', $manager->id)->get();
        return view('manager.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('manager.employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        // validate password
        $data = $request->validated();

        $passCheck = isPasswordComplex($request->password);
        if ($passCheck !== true):
            throw ValidationException::withMessages([
                'password' => $passCheck
            ]);
        endif;
        $data['image'] = $request->hasFile('image') ? Storage::disk('upload')->put('users', $request->file('image')) : null;
        if (!empty($request->password)):
            $data['password'] = Hash::make($request->password);
        endif;
        $user = auth('manager')->user();
        $data += [
            'type' => 'employee',
            'manager_id' => $user->id,
        ];
        $employee = Employee::create($data);
        if (!empty($request->departments)):
            $employee->departments()->attach($request->departments);
        endif;
        flash(trans('app.save_success'), 'success');
        return redirect(route('manager.employee.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        // return $employee->departments->pluck('id');
        return view('manager.employees.edit', compact('departments', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {

        // validate password
        $data = $request->validated();
        if (!empty($request->password)):
            $passCheck = isPasswordComplex($request->password);
            if ($passCheck !== true):
                throw ValidationException::withMessages([
                    'password' => $passCheck
                ]);
            endif;
            $data['password'] = Hash::make($request->password);
        else:
            $data['password'] = $employee->password;
        endif;
        if ($request->hasFile('image')):
            deleteUserImage($employee);
            $data['image'] = Storage::disk('upload')->put('users', $request->file('image'));
        else:
            $data['image'] = $employee->image;
        endif;

        $employee->update($data);
        if (!empty($request->departments)):
            $employee->departments()->sync($request->departments);
        endif;
        flash(trans('app.save_success'), 'success');
        return redirect(route('manager.employee.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->manager_id != auth('manager')->user()->id):
            return $this->errorResponse(trans('app.error_not_found'));
        endif;
        deleteUserImage($employee);
        $employee->delete();
        return $this->successResponse(message: trans('app.delete_success'));
    }
}
