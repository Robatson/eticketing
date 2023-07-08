<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class AddEvent extends Model
{
    use HasFactory;
   

    protected $guarded = [];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'event_name'
            ]
        ];
    }
}
