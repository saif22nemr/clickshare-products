<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\ManagerRequest;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = [
            'employees_count' => Employee::whereNotNull('manager_id')->count(),
            'managers_count' => Manager::count(),
            'admins_count' => Admin::count(),
            'departments_count' => Department::count(),
            'tasks_count' => Task::count(),
            'tasks_in_progress_count' => Task::where('status' , 'in_progress')->count(),
            'tasks_complete_count' => Task::where('status' , 'complete')->count(),
            'tasks_canceled_count' => Task::where('status' , 'canceled')->count(),
            'salary' => Employee::sum('salary'),
        ];
        return view('admin.home'  , compact('data'));
    }

    public function profile(Request $request)
    {
        $admin = auth('admin')->user();
        // validate password
        if ($request->method() == 'POST'):
            $dd = $request->all();
            $dd['image'] = $request->file('image');
            $req = new AdminProfileRequest( $dd);
            $data = $req->validate( $req->rules());
            if (!empty($request->password)):
                $passCheck = isPasswordComplex($request->password);
                if ($passCheck !== true):
                    throw ValidationException::withMessages([
                        'password' => $passCheck
                    ]);
                endif;
                $data['password'] = Hash::make($request->password);
            else:
                $data['password'] = $admin->password;
            endif;
            if ($request->hasFile('image')):
                deleteUserImage($admin);
                $data['image'] = Storage::disk('upload')->put('users', $request->file('image'));
            else:
                $data['image'] = $admin->image;
            endif;

            $admin->update($data);
            flash(trans('app.save_success'), 'success');
            return redirect(route('admin.profile'));
        endif;
        return view('admin.profile_edit' , compact('admin'));
    }
}
