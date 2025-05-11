<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return redirect()->route('permission.create')->with('success', 'Permission created successfully.');
    }
}
