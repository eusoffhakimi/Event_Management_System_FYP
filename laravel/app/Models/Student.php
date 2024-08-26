<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Eventcategory;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    public $table = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_phone_number','student_matric','student_picture','course_id','eventcategory_id','hobby_id','user_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function eventcategory()
    {
        return $this->belongsTo(Eventcategory::class);
    }

    public function hobby()
    {
        return $this->belongsTo(Hobby::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
}
