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
        
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'atlet',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'ownerClub',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'managementClub',
            'guard_name' => 'web'
        ]);

    }
}
