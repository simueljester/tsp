<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    //
    protected $table = 'articles';
    //
    protected $fillable = [
        'name','slug','thumbnail','description','service_id','is_featured','published_at'
    ];

    protected $dates = [
        'published_at',
   ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
