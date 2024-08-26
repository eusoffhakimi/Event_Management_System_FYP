<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_seed = [
            ['id'=>'1','course_code'=>'Open','course_name'=>'Open'],
            ['id'=>'2','course_code'=>'CDCS110','course_name'=>'Diploma In Computer Science'],
            ['id'=>'3','course_code'=>'CDCS230','course_name'=>'Bachelor of Computer Science (hons.)'],
            ['id'=>'4','course_code'=>'CDCS251','course_name'=>'Bachelor of Computer Science (hons.) Netcentric Computing'],
            ['id'=>'5','course_code'=>'CDCS253','course_name'=>'Bachelor of Computer Science (hons.) Multimedia Computing'],
            ['id'=>'6','course_code'=>'CDCS255','course_name'=>'Bachelor of Computer Science (hons.) Computer Networks'],
            ['id'=>'7','course_code'=>'CDCS266','course_name'=>'Bachelor of Information Systems (hons.) Information Systems Engineering'],
        ];

        foreach ($course_seed as $course_seed)
        {
            Course::firstOrCreate($course_seed);
        }
    }
}
