<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }


    public  function create()
    {
        $roles = Role::all();
        return view('users.add', compact('roles'));

    }

    public function store(Request $request)
    {

        $request = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $request['password'] = Hash::make($request['password']);
        $user=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

         $roles = Role::whereIn('id', $request['roles'])->pluck('name')->toArray();
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $data['password'] = Hash::make($data['password']);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }
}
