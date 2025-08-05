<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Factories\PermissionRoleFactory;
use Database\Factories\RoleUserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(3)->create();
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();
        //  PermissionRoleFactory::factory()->create();
        //  RoleUserFactory::factory()->create();

        foreach ($users as $user) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $role->id,
            ]);
        }

        // Assign permission ke role
        DB::table('permission_role')->insert([
            'permission_id' => $permission->id,
            'role_id' => $role->id,
        ]);
    }
}
