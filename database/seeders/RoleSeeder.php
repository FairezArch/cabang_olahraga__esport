<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Club Owner/BOD',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Organization members',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Club Members',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Event Organization',
            'guard_name' => 'web'
        ]);
    }
}
