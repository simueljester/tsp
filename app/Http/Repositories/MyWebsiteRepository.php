<?php
namespace App\Http\Repositories;


use Carbon\Carbon;
use App\MyWebsite;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class MyWebsiteRepository extends BaseRepository
{
    function __construct(MyWebsite $model)
    {
        $this->model = $model;
    }
}
