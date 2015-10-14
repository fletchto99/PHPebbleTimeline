<?php

namespace TimelineAPI;

use Exception;

class PinAction {

    private $title;
    private $launchcode;
    private $type;

    function __construct($title, $launchcode, $type) {
        if ($title == null || $launchcode == null) {
            throw new Exception("Launchcode and title both must be specified");
        }
        $this->title = $title;
        $this->launchcode = $launchcode;
        $this->type = $type;
    }

    function getData() {
        return array_filter(['type' => $this->type, 'title' => $this->title, 'launchCode' => $this->launchcode]);
    }

}

class PinActionType {
    const OPEN_WATCH_APP = 'openWatchApp';
}