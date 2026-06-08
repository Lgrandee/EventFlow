<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;



#[Fillable(['name', 'location', 'start_time', 'description', 'Category_id', 'max-attendees', 'created_by'])]
class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'location',
        'start_time',
        'description',
        'Category_id',
        'max-attendees',
        'created_by',
    ];
}