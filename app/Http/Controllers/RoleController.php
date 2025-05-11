<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

     public function create()
    {
        return view('admin.roles-permissions.roles.add');
    }

    public function store(Request $request)
    {
        // Validate and store the permission
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        // Store the permission in the database
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('role.list')->with('success', 'Role created successfully.');
    }

    public function list()
    {
        $roles = Role::all();
        return view('admin.roles-permissions.roles.list', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles-permissions.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the permission
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$id,
        ]);

        // Update the permission in the database
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role.list')->with('success', 'Role updated successfully.');
    }


    public function delete($id)
    {
        // Delete the permission
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.list')->with('success', 'Role deleted successfully.');
    }

    public function addPermissionToRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();
        return view('admin.roles-permissions.roles.add-permission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function storePermissionToRole(Request $request, $id)
    {
        // Validate and store the permission
        $request->validate([
            'permissions' => 'required|array',
        ]);

        // Store the permission in the database
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.list')->with('success', 'Role permissions updated successfully.');
    }
}
