<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{

    protected $table = 'reviews';
    //
    protected $fillable = [
        'comment','commented_by','service_id','rating'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
