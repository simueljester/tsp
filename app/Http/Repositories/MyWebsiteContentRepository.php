<?php
namespace App\Http\Repositories;


use Carbon\Carbon;
use App\MyWebsiteContent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class MyWebsiteContentRepository extends BaseRepository
{
    function __construct(MyWebsiteContent $model)
    {
        $this->model = $model;
    }
}
