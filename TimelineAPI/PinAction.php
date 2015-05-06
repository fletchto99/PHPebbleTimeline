<?php


namespace TimelineAPI;

class PinAction {

    private $title;
    private $launchcode;
    private $type;

    function __construct($title, $launchcode, $type= null) {
        if ($title == null || $launchcode == null) {
            throwException("Launchcode and title both must be specified");
        }
        $this -> title = $title;
        $this -> launchcode = $launchcode;
        if ($type == null) {
            $this->type = PinActionType::OPEN_WATCH_APP;
        }
    }

    function getDataArray() {
        return array_filter([ 'type' => $this -> type, 'title' => $this -> title, 'launchcode' => $this -> launchcode]);
    }

}

class PinActionType
{
    const OPEN_WATCH_APP = 'openWatchApp';
}