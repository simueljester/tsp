<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyWebsiteContent extends Model
{
    //
    protected $table = 'my_website_contents';
    //
    protected $fillable = [
        'my_website_id','content_code','data'
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(MyWebsite::class);
    }

}
