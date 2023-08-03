<?php
namespace App\Http\Repositories;

use App\Service;

class ServiceRepository extends BaseRepository
{
    function __construct(Service $model)
    {
        $this->model = $model;
    }
}
