<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            '1' => ['dashboards'],
            '2' =>  [ 
                'roles-list',
                'roles-create',
                'roles-edit',
                'roles-delete'
            ],
            '3' =>  [ 
                'admins-list',
                'admins-create',
                'admins-edit',
                'admins-delete'
            ],
            '4' =>  [ 
                'games-list',
                'games-create',
                'games-edit',
                'games-delete'
            ],
            '5' =>  [ 
                'clubs-list',
                'clubs-create',
                'clubs-edit',
                'clubs-delete'
            ],
            '6' =>  [ 
                'news-list',
                'news-create',
                'news-edit',
                'news-delete'
            ],
            '7' =>  [ 
                'events-list',
                'events-create',
                'events-edit',
                'events-delete'
            ],
            '8' =>  [ 
                'awards-list',
                'awards-create',
                'awards-edit',
                'awards-delete'
            ],
            '9' =>  [ 
                'organizations-list',
                'organizations-create',
                'organizations-edit',
                'organizations-delete'
            ],
            '10' =>  [ 
                'organizations-event-list',
                'organizations-event-create',
                'organizations-event-edit',
                'organizations-event-delete'
            ],
            '11' =>  [ 
                'members-list',
                'members-create',
                'members-edit',
                'members-delete'
            ],
            '12' =>  [ 
                'teams-list',
                'teams-create',
                'teams-edit',
                'teams-delete'
            ],
            '13' =>  [ 
                'branchs-list',
                'branchs-create',
                'branchs-edit',
                'branchs-delete'
            ],
            '14' =>  [ 
                'users-list',
                'users-create',
                'users-edit',
                'users-delete'
            ]
        ];

        foreach ($permissions as $permission => $values) {
            foreach($values as $value){
                Permission::create(['parent'=>$permission,'name' => $value]);
            }
        }
    }
}
