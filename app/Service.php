<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $table = 'services';
    //
    protected $fillable = [
        'name','slug','type','description','category_id','icon','multimedia','files','published_at'
    ];

    protected $dates = [
        'published_at',
   ];
}
