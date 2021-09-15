<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MemberSeeder extends Seeder
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
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.id',
            'password' => bcrypt('123123'),
        ]);

        $user->assignRole('user');
    }
}
