<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menus_web;

class ParentMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $parents = [
            'Dashboards',
            'Roles',
            'Admin',
            'Games',
            'Clubs',
            'News',
            'Events',
            'Awards',
            'Organizations',
            'Organizations event',
            'Members',
            'Teams',
            'Cabang Olahraga',
            'Users'
        ];
        Menus_web::query()->truncate();

        foreach($parents as $parent){
            Menus_web::insert(['name_menu'=>$parent]);
        }
    }
}
