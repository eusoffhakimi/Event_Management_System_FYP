<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Club;
use App\Models\Course;
use App\Models\Eventstatus;
use App\Models\Eventcategory;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory;

    use SoftDeletes;

    use Notifiable;

    public $table = 'event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'club_id','event_title','event_description','event_poster','course_id','event_venue','event_capacity','event_payment','event_price','event_qr','event_start_time','event_end_time','event_start_date','event_end_date','eventstatus_id','eventcategory_id','event_verification_code',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function eventstatus()
    {
        return $this->belongsTo(Eventstatus::class);
    }

    public function eventcategory()
    {
        return $this->belongsTo(Eventcategory::class);
    }

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }

}
