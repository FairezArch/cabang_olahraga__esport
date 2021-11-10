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
            'name' => 'Aldi',
            'lastname' => 'Firmansyah',
            'address' => 'Jl. Jatinegara Timur No.4 RT.11, RT.4/RW.3, Bali Mester, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13310',
            'email' => 'admin@example.id',
            'active' => 99,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);

        $admin->assignRole('superadmin');

        $ownerClub = User::create([
            'name' => 'Burhan',
            'lastname' => 'Pratama',
            'address' => 'Jl. A. Yani No.117, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134',
            'email' => 'burhanpratama@example.id',
            'active' => 99,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);

        $ownerClub->assignRole('ownerClub');

        $managementClub = User::create([
            'name' => 'Joko',
            'lastname' => 'aryanto',
            'address' => 'Jl. A. Yani No.117, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134',
            'email' => 'jokoaryanto@example.id',
            'active' => 99,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);

        $managementClub->assignRole('managementClub');

        $managementClub1 = User::create([
            'name' => 'Ratna',
            'lastname' => 'Pratiwi',
            'address' => 'Jl. A. Yani No.117, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134',
            'email' => 'ratnapratiwi@example.id',
            'active' => 99,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);

        $managementClub1->assignRole('managementClub');

        $user = User::create([
            'name' => 'Fauzan',
            'lastname' => 'Amir',
            'address' => 'Jl. Balekambang No.7, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139',
            'email' => 'fauzanamir@example.id',
            'active' => 1,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);

        $user->assignRole('atlet');

        
        $user1 = User::create([
            'name' => 'Rangga',
            'lastname' => 'Dhari',
            'address' => 'Jl. DI Panjaitan, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134',
            'email' => 'ranggadhari@example.id',
            'active' => 1,
            'active_member' => 1,
            'cabang_id' => 1,
            'password' => bcrypt('123123')
        ]);
        
        $user1->assignRole('atlet');
    }
}
