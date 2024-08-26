<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobby_seed = [
            ['id'=>'1','hobby_name'=>'Board Games/Card Games'],
            ['id'=>'2','hobby_name'=>'Coding/Programming'],
            ['id'=>'3','hobby_name'=>'Cooking/Baking'],
            ['id'=>'4','hobby_name'=>'Drawing/Painting'],
            ['id'=>'5','hobby_name'=>'Gardening'],
            ['id'=>'6','hobby_name'=>'Hiking'],
            ['id'=>'7','hobby_name'=>'Knitting/Crocheting'],
            ['id'=>'8','hobby_name'=>'Learning Languages'],
            ['id'=>'9','hobby_name'=>'Photography'],
            ['id'=>'10','hobby_name'=>'Playing Musical Instruments'],
            ['id'=>'11','hobby_name'=>'Playing Esports'],
            ['id'=>'12','hobby_name'=>'Playing Sports'],
            ['id'=>'13','hobby_name'=>'Reading'],
            ['id'=>'14','hobby_name'=>'Volunteering'],
            ['id'=>'15','hobby_name'=>'Writing'],
        ];

        foreach ($hobby_seed as $hobby_seed)
        {
            Hobby::firstOrCreate($hobby_seed);
        }
    }
}
