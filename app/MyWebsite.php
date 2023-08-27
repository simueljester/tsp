<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyWebsite extends Model
{
    //
    protected $table = 'my_website';
    //
    protected $fillable = [
        'name','data','active','completed_at'
    ];

    protected $dates = [
        'completed_at',
   ];
}
