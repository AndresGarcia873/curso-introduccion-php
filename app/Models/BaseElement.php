<?php

namespace App\Models;

class BaseElement implements Printable {
    protected $title;
    public $description;
    public $visible;
    public $months;

    public function __construct($title, $description) {
        $this->setTitle($title);
        $this->description = $description;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if ($title == '') {
            $this->title = 'N/A';
        }else {
            $this->title = $title;
        }
    }

    public function getDurationAsString() {
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        if ($years == 0 && $extraMonths == 1) {
            $string = "$extraMonths month";
        }else if ($extraMonths == 0 && $years == 1) {
            $string = "$years year";
        }else if ($years == 1 && $extraMonths == 1){
            $string = "$years year $extraMonths month";
        }else if ($years == 1 && $extraMonths > 1){
            $string = "$years year $extraMonths months";
        }else if ($years == 0 && $extraMonths > 1){
            $string = "$extraMonths months";
        }else if ($extraMonths == 0 && $years > 1){
            $string = "$years years";
        }else {
            $string = "$years years $extraMonths months";
        }
        return $string;
    }

    public function getDescription() {
        return $this->description;
    }
}