<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChooseUs extends Model
{
    //
    protected $table = 'choose_us';
    //
    protected $fillable = [
        'icon','name','description','active'
    ];
}
