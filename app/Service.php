<?php

namespace App;

use App\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
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

    // Relations

   public function category(): BelongsTo
   {
       return $this->belongsTo(ServiceCategory::class);
   }

}
