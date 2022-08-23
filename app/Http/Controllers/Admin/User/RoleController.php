<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Models\Admin\User\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRoleRequest;
use App\Http\Requests\Admin\User\UpdatePermissionRoleRequest;
use App\Http\Requests\Admin\User\UpdateRoleRequest;
use App\Models\Admin\User\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.user.role.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $permissions = Permission::all();
        return view('admin.user.role.create',compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $inputs = $request->all();

        $role = Role::create($inputs);
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('role.index')->with('swal-success', 'نقش جدید با موفقیت ثبت شد');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.user.role.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request,Role $role)
    {

        $inputs = $request->all();
        $role->update($inputs);
        return redirect()->route('role.index')->with('swal-success', ' ویرایش با موفقیت انجام شد');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('swal-success', 'قانون شما با موفقیت حذف شد');

    }


    public function permissionForm(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.set-permission', compact('role', 'permissions'));

    }


    public function permissionUpdate(UpdatePermissionRoleRequest $request,Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('role.index')->with('swal-success', ' موفقیت ثبت شد');

    }
}
