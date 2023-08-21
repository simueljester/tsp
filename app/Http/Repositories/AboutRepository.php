<?php
namespace App\Http\Repositories;

use App\About;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class AboutRepository extends BaseRepository
{
    function __construct(About $model)
    {
        $this->model = $model;
    }
}
