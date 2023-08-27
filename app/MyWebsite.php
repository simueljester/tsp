<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function contents(): HasMany
    {
        return $this->hasMany('App\MyWebsiteContent', 'my_website_id','id');
    }
}
