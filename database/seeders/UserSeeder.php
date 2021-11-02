<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::query()->truncate();
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.id',
            'password' => bcrypt('123123'),
            'active' => 99,
            'cabang_id' => 1
        ]);

        $admin->assignRole('superadmin');

        $bod = User::create([
            'name' => 'BOD',
            'email' => 'bod@example.id',
            'password' => bcrypt('123123'),
            'active' => 99,
            'cabang_id' => 1
        ]);

        $bod->assignRole('Club Owner/BOD');

        $org_member = User::create([
            'name' => 'org_member',
            'email' => 'org_member@example.id',
            'password' => bcrypt('123123'),
            'active' => 99,
            'cabang_id' => 1
        ]);

        $org_member->assignRole('Organization members');

        $club_member = User::create([
            'name' => 'club_member',
            'email' => 'club_member@example.id',
            'password' => bcrypt('123123'),
            'active' => 99,
            'cabang_id' => 1
        ]);

        $club_member->assignRole('Club Members');

        $ev_org = User::create([
            'name' => 'ev_org',
            'email' => 'ev_org@example.id',
            'password' => bcrypt('123123'),
            'active' => 99,
            'cabang_id' => 1
        ]);

        $ev_org->assignRole('Event Organization');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.id',
            'password' => bcrypt('123123'),
            'active' => 1,
            'cabang_id' => 1
        ]);

        $user->assignRole('user');
       
    }
}
