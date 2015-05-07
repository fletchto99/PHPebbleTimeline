<?php

namespace TimelineAPI;

use DateTime;

require_once 'PinAction.php';
require_once 'PinLayout.php';
require_once 'PinNotification.php';
require_once 'PinReminder.php';

class Pin
{

    private $time;
    private $layout;
    private $id;
    private $duration;
    private $createNotification;
    private $updateNotification;
    private $pinAction;
    private $reminders = Array();


    function __construct($id, DateTime $time, PinLayout $layout, $duration = null, PinNotification $createNotification = null, PinNotification $updateNotification = null, PinAction $pinAction = null)
    {
        if ($id == null) {
            throwException('ID cannot be null');
        }
        $this -> id = $id;
        if ($time != null) {
            $this -> time = $time -> format('Y-m-d\TH:i:s\Z');
        }
        $this -> layout = $layout;
        $this -> duration = $duration;
        $this -> createNotification = $createNotification;
        $this -> updateNotification = $updateNotification;
        $this -> pinAction = $pinAction;
    }

    function getID() {
        return $this -> id;
    }

    function getData() {
        $createNotification = $this -> updateNotification ? $this -> updateNotification -> getData() : null;
        $updateNotification = $this -> updateNotification ? $this -> updateNotification -> getData() : null;
        return array_filter(['id' => $this -> id, 'time' => $this -> time, 'duration' => $this -> duration,'createNotification' => $createNotification, 'updateNotification' => $updateNotification,'layout' => $this -> layout -> getData(), 'reminders' => $this -> reminders, '' ]);
    }

    function addReminder(PinReminder $reminder) {
        if (count($this -> reminders) < 3 ) {
                array_push($this -> reminders, $reminder -> getData());
                return true;
        }
        return false;
    }

}

?>