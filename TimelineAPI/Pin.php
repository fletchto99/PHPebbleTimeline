<?php

class Pin
{

    private $time;
    private $layout;
    private $id;
    private $duration;


    function __construct($id, DateTime $time, PinLayout $layout, $duration = null)
    {
        if ($id == null) {
            throwException('ID cannot be null');
        }
        $this -> id = $id;
        $this -> time = $time;
        $this -> layout = $layout;
        $this -> duration = $duration;
    }

    function getID() {
        return $this -> id;
    }

    function getData() {
    return ['id' => $this -> id];
    }

    function addReminder(PinReminder $reminder) {

    }

    /**
     *
     */
    function addAction(PinAction $action) {

    }

    function addCreateNotification(PinNotification $notification) {

    }

    function addUpdateNotification(PinNotification $notification) {

    }

}

?>