<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ManagerRequest;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = auth('web')->user();
        $admins = User::orderByDesc('created_at')->where('id' , '!=' , $admin->id)->get();
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

        if (!empty($request->password)):
            $data['password'] = Hash::make($request->password);
        endif;
        $user = auth('web')->user();
        $data += [
            'type' => 'admin',
            'manager_id' => $user->id,
        ];
        $manager = User::create($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('admin.admin.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {

        return view('admin.admins.edit', compact( 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerRequest $request, User $admin)
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

        $admin->update($data);
        flash(trans('app.save_success'), 'success');
        return redirect(route('admin.admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return $this->successResponse(message: trans('app.delete_success'));
    }
}
