<?php

namespace Database\Seeders;

use App\Models\Eventcategory;
use Illuminate\Database\Seeder;

class EventcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventcategory_seed = [
            ['id'=>'1','eventcategory_name'=>'Alumni Event'],
            ['id'=>'2','eventcategory_name'=>'Awards Ceremony Event'],
            ['id'=>'3','eventcategory_name'=>'Cultural Event'],
            ['id'=>'4','eventcategory_name'=>'Esports Event'],
            ['id'=>'5','eventcategory_name'=>'Exhibition/Fair Event'],
            ['id'=>'6','eventcategory_name'=>'Hackathon Event'],
            ['id'=>'7','eventcategory_name'=>'Orientation Event'],
            ['id'=>'8','eventcategory_name'=>'Performance (Music, Theater, Dance) Event'],
            ['id'=>'9','eventcategory_name'=>'Sports Event'],
            ['id'=>'10','eventcategory_name'=>'Talk (Lecture, Debate, Conference, Seminar) Event'],
            ['id'=>'11','eventcategory_name'=>'Volunteer Event'],
            ['id'=>'12','eventcategory_name'=>'Workshop Event'],
        ];

        foreach ($eventcategory_seed as $eventcategory_seed)
        {
            Eventcategory::firstOrCreate($eventcategory_seed);
        }
    }
}
