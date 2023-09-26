<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ServiceTrait {

    public function fetchAverageRating($arrayRatings) {
        $ave = array_sum($arrayRatings)/count($arrayRatings);
        return round($ave);
    }

}
