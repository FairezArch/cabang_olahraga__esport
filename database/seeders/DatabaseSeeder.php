<?php

namespace Database\Seeders;

use App\Models\Branchsport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(ParentMenuSeeder::class);
        $this->call(BranchSeeder::class);
        // $this->call(RoleNameSeeder::class);
    }
}
