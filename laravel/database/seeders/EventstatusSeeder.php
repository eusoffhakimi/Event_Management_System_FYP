<?php

namespace Database\Seeders;

use App\Models\Eventstatus;
use Illuminate\Database\Seeder;

class EventstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventstatus_seed = [
            ['id'=>'1','eventstatus_name'=>'Open'],
            ['id'=>'2','eventstatus_name'=>'Close'],
        ];

        foreach ($eventstatus_seed as $eventstatus_seed)
        {
            Eventstatus::firstOrCreate($eventstatus_seed);
        }
    }
}
