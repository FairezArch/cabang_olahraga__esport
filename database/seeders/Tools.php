<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\Toolanswer;
use App\Models\Branchsport;
class Tools extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $inputs = ["text","file","checkbox","radio","select"];
        // Toolanswer::query()->truncate();
        // foreach($inputs as $input){
        //     Toolanswer::create(['component'=>$input]);
        // }
        Branchsport::query()->truncate();
        Branchsport::create(['name'=>'Esport','user_id'=>1]);
        
    }
}
