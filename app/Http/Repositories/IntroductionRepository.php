<?php
namespace App\Http\Repositories;


use Carbon\Carbon;
use App\Introduction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class IntroductionRepository extends BaseRepository
{
    function __construct(Introduction $model)
    {
        $this->model = $model;
    }
}
