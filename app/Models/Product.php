<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SLuggable;

class Product extends Model
{
    use HasFactory;
    use SLuggable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category',
       'featured_image',
        'status',
         'meta_title', 'meta_description', 'focus_keywords','volume','brand'
    ];

    public function Sluggable():array
    {
        return [

            'slug'=>
            [
                'source'=>'title'
            ]
        ];
    }
}
