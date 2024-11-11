<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\ManagerRequest;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        $data = [
            'products_count' => Product::count() ,
            'products_quantity' => Product::sum('quantity') ?? 0,
            'admins_count' => User::count(),
        ];
        return view('admin.home'  , compact('data'));
    }

    public function profile(Request $request)
    {
        $admin = auth('web')->user();
        // validate password
        if ($request->method() == 'POST'):
            $dd = $request->all();
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
