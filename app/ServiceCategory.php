<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

   public function services(): HasMany {
    return $this->hasMany('App\Service', 'category_id','id');
}

}
