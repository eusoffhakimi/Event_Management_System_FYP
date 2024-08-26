<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventcategory extends Model
{
    use HasFactory;

    public $table = 'eventcategory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'eventcategory_name',
    ];

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
