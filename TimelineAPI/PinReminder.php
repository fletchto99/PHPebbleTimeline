<?php

namespace TimelineAPI;

use DateTime;

class PinReminder {

    private $layout;
    private $time;

    function __construct($layout, DateTime $time = null) {
        $this -> layout = $layout;
        if ($time != null) {
            $this -> time = $time -> format(DateTime::ISO8601);
        }
    }

    function getData() {
        return array_filter(['layout' => $this -> layout, 'time' => $this -> time]);
    }

}