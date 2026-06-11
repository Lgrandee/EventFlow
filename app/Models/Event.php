<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'start_time',
        'description',
        'category_id',
        'max_attendees',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'event_user',
            'event_id',
            'user_id'
        );
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'event_id');
    }
}