<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;

class PermissionsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('permission_access')) {
            return abort(401);
        }


                $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        if (! Gate::allows('permission_create')) {
            return abort(401);
        }
        return view('admin.permissions.create');
    }

    public function store(StorePermissionsRequest $request)
    {
        if (! Gate::allows('permission_create')) {
            return abort(401);
        }
        $permission = Permission::create($request->all());



        return redirect()->route('admin.permissions.index');
    }

    public function edit($id)
    {
        if (! Gate::allows('permission_edit')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionsRequest $request, $id)
    {
        if (! Gate::allows('permission_edit')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());



        return redirect()->route('admin.permissions.index');
    }

    public function show($id)
    {
        if (! Gate::allows('permission_view')) {
            return abort(401);
        }
        $roles = \App\Role::whereHas('permission',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $permission = Permission::findOrFail($id);

        return view('admin.permissions.show', compact('permission', 'roles'));
    }

    public function destroy($id)
    {
        if (! Gate::allows('permission_delete')) {
            return abort(401);
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('admin.permissions.index');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('permission_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
