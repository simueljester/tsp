<?php
namespace App\Http\Repositories;


use Carbon\Carbon;
use App\ServiceCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ServiceCategoryRepository extends BaseRepository
{
    function __construct(ServiceCategory $model)
    {
        $this->model = $model;
    }
}
