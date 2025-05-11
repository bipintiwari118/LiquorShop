<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create()
    {
        return view('admin.roles-permissions.permissions.add');
    }

    public function store(Request $request)
    {
        // Validate and store the permission
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        // Store the permission in the database
        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permission.list')->with('success', 'Permission created successfully.');
    }

    public function list()
    {
        $permissions = Permission::all();
        return view('admin.roles-permissions.permissions.list', compact('permissions'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.roles-permissions.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the permission
        $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$id,
        ]);

        // Update the permission in the database
        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permission.list')->with('success', 'Permission updated successfully.');
    }
      

    public function delete($id)
    {
        // Delete the permission
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permission.list')->with('success', 'Permission deleted successfully.');
    }
}
