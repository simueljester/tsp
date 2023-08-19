<?php
namespace App\Http\Repositories;


use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ArticleRepository extends BaseRepository
{
    function __construct(Article $model)
    {
        $this->model = $model;
    }
}
