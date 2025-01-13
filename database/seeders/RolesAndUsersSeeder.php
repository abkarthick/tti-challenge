<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super_admin']);
        $manager = Role::create(['name' => 'manager']);
        $employee = Role::create(['name' => 'employee']);

        // Create users
        $user1 = User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);
        $user1->assignRole($superAdmin);

        $user2 = User::create(['name' => 'Manager', 'email' => 'manager@example.com', 'password' => bcrypt('password')]);
        $user2->assignRole($manager);

        $user3 = User::create(['name' => 'Employee', 'email' => 'employee@example.com', 'password' => bcrypt('password')]);
        $user3->assignRole($employee);
    }
}
