<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    protected $table = 'jobs';

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        if ($years == 0 && $extraMonths == 1) {
            $string = "Job duration: $extraMonths month";
        }else if ($extraMonths == 0 && $years == 1) {
            $string = "Job duration: $years year";
        }else if ($years == 1 && $extraMonths == 1){
            $string = "Job duration: $years year $extraMonths month";
        }else if ($years == 1 && $extraMonths > 1){
            $string = "Job duration: $years year $extraMonths months";
        }else if ($years == 0 && $extraMonths > 1){
            $string = "Job duration: $extraMonths months";
        }else if ($extraMonths == 0 && $years > 1){
            $string = "Job duration: $years years";
        }else {
            $string = "Job duration: $years years $extraMonths months";
        }
        return $string;
    }
}