<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ManagerRequest;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = auth('admin')->user();
        $admins = Admin::orderByDesc('created_at')->where('id' , '!=' , $admin->id)->get();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagerRequest $request)
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
        $user = auth('admin')->user();
        $data += [
            'type' => 'admin',
            'manager_id' => $user->id,
        ];
        $manager = Admin::create($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('admin.admin.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {

        return view('admin.admins.edit', compact( 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerRequest $request, Admin $admin)
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
        return redirect(route('admin.admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        deleteUserImage($admin);
        $admin->delete();
        return $this->successResponse(message: trans('app.delete_success'));
    }
}
