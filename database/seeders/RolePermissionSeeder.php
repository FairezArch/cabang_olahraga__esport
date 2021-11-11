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

        $ownerClubPermissions = [
            '1' => [1],
            '2' => [14],
            '3' => [16],
            '4' => [30,31,32,33,34,35,36,37],
            '5' => [38,39,40,41]
        ];

        foreach ($ownerClubPermissions as $permissionClub => $valuePermissions) {
            foreach($valuePermissions as $valuePermission){

                DB::table('role_has_permissions')->insert([
                    'permission_id' => $valuePermission,
                    'role_id'=>3
                ]);
                
            }
        }

        $managementPermissions = [
            '1' => [1],
            '2' => [14],
            '3' => [16],
            '4' => [30,34,35,36,37],
            '5' => [38,39,40,41]
        ];

        foreach ($managementPermissions as $managementPermission => $valueManagementPermissions) {
            foreach($valueManagementPermissions as $valueManagementPermission){
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $valueManagementPermission,
                    'role_id'=>4
                ]);
            }
        }

        $atletPermissions = ['1'=>[1]];

        foreach ($atletPermissions as $atletPermission => $valuePermissions) {
            foreach($valuePermissions as $valuePermission){

                DB::table('role_has_permissions')->insert([
                    'permission_id' => $valuePermission,
                    'role_id'=>2
                ]);

            }
        }

        
    }
}
