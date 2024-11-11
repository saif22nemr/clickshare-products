<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // hashed "password" : $2y$12$/3v4YSZAchte.C88rYVKb.kg/35OoRX6smQoNUUjdhFHfsQ440Czi
    public function login(Request $request)
    {
        // if (checkAuth() !== null):
        //     return redirect(getHomeUrl());
        // endif;
        if ($request->method() == 'POST'):
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:1|string|max:100',
            ]);
            $user = User::where('email', $request->email)->first();
            // return $user->password;
            if (Hash::check($request->password, $user->password)):
                if ($user->type == 'admin'):
                    auth('web')->login($user, $request->remember_me ?? false);
                    return redirect(route('admin.home'));
                elseif ($user->type == 'manager'):
                    auth('web')->login($user, $request->remember_me ?? false);
                    return redirect(route('manager.home'));
                elseif ($user->type == 'employee'):
                    auth('web')->login($user, $request->remember_me ?? false);
                    return redirect(route('employee.home'));
                endif;
            else:
                throw ValidationException::withMessages([
                    'password' => trans('app.error_password_wrong')
                ]);
            endif;// end check password
        endif; // end method post

        return view('login');
    }

    public function logout(Request $request)
    {
        if (isUrlActive('admin')):
            auth('web')->logout();
        elseif (isUrlActive('manager')):
            auth('web')->logout();
        elseif (isUrlActive('employee')):
            auth('web')->logout();
        else:
            auth('web')->logout();
            auth('web')->logout();
            auth('web')->logout();
        endif;
        return redirect(route('login'));
    }

    public function loginAs($type)
    {
        if ($type == 'admin'):
            $admin = Admin::first();
            auth('web')->login($admin);
            return redirect(route('admin.home'));
        elseif ($type == 'manager'):
            $manager = Manager::first();
            auth('web')->login($manager);
            return redirect(route('manager.home'));
        else:
            $employee = Employee::first();
            auth('web')->login($employee);
            return redirect(route('employee.home'));
        endif;
    }
}
