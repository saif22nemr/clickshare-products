<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ManagerRequest;
use App\Models\Department;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ManagerController extends Controller
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
        $managers = Manager::with('departments')->withCount('employees')->orderByDesc('created_at')->get();
        return view('admin.managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.managers.create', compact('departments'));
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
        $user = auth('web')->user();
        $data += [
            'type' => 'manager',
            'manager_id' => $user->id,
        ];
        $manager = Manager::create($data);
        if (!empty($request->departments)):
            $manager->departments()->attach($request->departments);
        endif;
        flash(trans('app.save_success'), 'success');
        return redirect(route('admin.manager.index'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        $departments = Department::all();
        // return $manager->departments->pluck('id');
        return view('admin.managers.edit', compact('departments', 'manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerRequest $request, Manager $manager)
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
            $data['password'] = $manager->password;
        endif;
        if ($request->hasFile('image')):
            deleteUserImage($manager);
            $data['image'] = Storage::disk('upload')->put('users', $request->file('image'));
        else:
            $data['image'] = $manager->image;
        endif;

        $manager->update($data);
        if (!empty($request->departments)):
            $manager->departments()->sync($request->departments);
        endif;
        flash(trans('app.save_success'), 'success');
        return redirect(route('admin.manager.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {

        deleteUserImage($manager);
        $manager->delete();
        return $this->successResponse(message: trans('app.delete_success'));
    }

    public function loginAsManager(Manager $manager)
    {
        auth('web')->login($manager);
        return redirect(route('manager.home'));
    }


}
