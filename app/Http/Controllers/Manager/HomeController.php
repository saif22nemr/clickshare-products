<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\managerProfileRequest;
use App\Models\Manager;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth:manager');
    }
    public function index(){
        $manager = auth('manager')->user();
        $data = [
            'employees_count' => Employee::where('manager_id' , $manager->id)->count(),
            'departments_count' => Department::count(),
            'tasks_count' => Task::where('manager_id' , $manager->id)->count(),
            'tasks_in_progress_count' => Task::where('manager_id' , $manager->id)->where('status' , 'in_progress')->count(),
            'tasks_complete_count' => Task::where('manager_id' , $manager->id)->where('status' , 'complete')->count(),
            'tasks_canceled_count' => Task::where('manager_id' , $manager->id)->where('status' , 'canceled')->count(),
            'salary' => Employee::where('manager_id' , $manager->id)->sum('salary'),
        ];
        return view('manager.home' , compact('data'));
    }
    public function profile(Request $request)
    {
        $manager = auth('manager')->user();
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
                $data['password'] = $manager->password;
            endif;
            if ($request->hasFile('image')):
                deleteUserImage($manager);
                $data['image'] = Storage::disk('upload')->put('users', $request->file('image'));
            else:
                $data['image'] = $manager->image;
            endif;

            $manager->update($data);
            flash(trans('app.save_success'), 'success');
            return redirect(route('manager.profile'));
        endif;
        return view('manager.profile_edit' , compact('manager'));
    }
}
