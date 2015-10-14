<?php

namespace TimelineAPI;

use DateTime;

class PinNotification {

    private $layout;
    private $time;

    function __construct(PinLayout $layout, DateTime $time = null) {
        $this->layout = $layout;
        if ($time != null) {
            $this->time = $time->format('Y-m-d\TH:i:s\Z');
        }
    }

    function getData() {
        return array_filter(['layout' => $this->layout->getData(), 'time' => $this->time]);
    }

}