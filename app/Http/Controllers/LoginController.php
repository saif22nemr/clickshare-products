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
        auth('web')->logout();
        return redirect(route('login'));
    }

    public function loginAs($type)
    {
        if(config('app.mode') != 'test'):
            return redirect(route('login'));
        endif;
        $admin = User::firstOrFail();
        auth('web')->login($admin);
        return redirect(route('admin.home'));
    }
}
