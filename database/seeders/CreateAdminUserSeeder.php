<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'OmarMahgoub',
            'email' => 'admin@app.com',
            'password' => bcrypt('123456'),
             'roles_name' => '["SuperAdmin"]',
             'status'=> 1
        ]);

        $role = Role::create(['name' => 'SuperAdmin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
