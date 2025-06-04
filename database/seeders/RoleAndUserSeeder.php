<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'Super-Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $subAdmin = Role::firstOrCreate(['name' => 'Sub-Admin']);

        // Create Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'bipintiwari118@gmail.com'],
            [
                'name' => 'Bipin Tiwari',
                'password' => Hash::make('password@123'), // change this
            ]
        );

        $user->assignRole($superAdmin);
    }

}
