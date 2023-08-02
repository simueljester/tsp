<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';
    //
    protected $fillable = [
        'name', 'description','published_at','is_featured','icon'
    ];

    protected $dates = [
        'published_at',
   ];
}
