<?php
namespace App\Http\Repositories;

use App\ChooseUs;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ChooseUsRepository extends BaseRepository
{
    function __construct(ChooseUs $model)
    {
        $this->model = $model;
    }
}
