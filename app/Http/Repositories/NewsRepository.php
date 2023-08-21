<?php
namespace App\Http\Repositories;


use Carbon\Carbon;
use App\News;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class NewsRepository extends BaseRepository
{
    function __construct(News $model)
    {
        $this->model = $model;
    }
}
