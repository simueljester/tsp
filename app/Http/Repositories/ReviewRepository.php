<?php
namespace App\Http\Repositories;

use App\Review;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ReviewRepository extends BaseRepository
{
    function __construct(Review $model)
    {
        $this->model = $model;
    }
}
