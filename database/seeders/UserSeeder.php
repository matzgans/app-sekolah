<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin',]);
        $stafRole = Role::create(['name' => 'staf']);
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        $adminUser->assignRole($adminRole);

        $stafUser = User::create([
            'name' => 'Staf',
            'email' => 'staf@staf.com',
            'password' => Hash::make('staf'),
        ]);
        $stafUser->assignRole($stafRole);
    }
}
