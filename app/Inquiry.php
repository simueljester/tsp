<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    //

    protected $table = 'inquiries';
    //
    protected $fillable = [
        'name','email','description','service_id','contact','viewed_at'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
