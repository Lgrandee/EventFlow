<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Category extends Model
{
    protected $fillable = ['name'];

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }
}
