<?php
namespace App\Http\Repositories;

use App\Inquiry;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class InquiryRepository extends BaseRepository
{
    function __construct(Inquiry $model)
    {
        $this->model = $model;
    }
}
