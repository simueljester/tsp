<?php

namespace App;

use App\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    //
    protected $table = 'services';
    //
    protected $fillable = [
        'name','slug','type','description','description_clean','category_id','icon','multimedia','files','published_at','is_featured','tags'
    ];

    protected $dates = [
        'published_at',
   ];

   public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relations

   public function category(): BelongsTo
   {
       return $this->belongsTo(ServiceCategory::class);
   }

   public function articles(): HasMany
   {
       return $this->hasMany('App\Article', 'service_id','id');
   }

}
