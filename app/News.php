<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
      //
      protected $table = 'news';
      //
      protected $fillable = [
          'name','slug','thumbnail','headline','description','is_featured','published_at','multimedia','tags'
      ];

      protected $dates = [
          'published_at',
     ];

}
