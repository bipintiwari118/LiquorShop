<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SLuggable;

class Category extends Model
{
    use HasFactory;
     use SLuggable;
    protected $fillable = [
        'name',
        'meta_title', 'meta_description', 'focus_keywords',

    ];

     public function Sluggable():array
    {
        return [

            'slug'=>
            [
                'source'=>'name'
            ]
        ];
    }
}
