<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\PermissionsModel;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('role_has_permissions')->query()->truncate();
        $permissions = PermissionsModel::get();
        foreach($permissions as $permission){
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id'=>1
            ]);
        }
        
    }
}
