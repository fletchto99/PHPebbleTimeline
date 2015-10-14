<?php

namespace TimelineAPI;

use DateTime;
use Exception;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'PinAction.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PinLayout.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PinNotification.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PinReminder.php';

class Pin {

    private $time;
    private $layout;
    private $id;
    private $duration;
    private $createNotification;
    private $updateNotification;
    private $actions = [];
    private $reminders = [];


    public function __construct($id, DateTime $time, PinLayout $layout, $duration = null, PinNotification $createNotification = null, PinNotification $updateNotification = null) {
        if ($id == null) {
            throw new Exception('ID cannot be null');
        }
        $this->id = $id;
        if ($time != null) {
            $this->time = $time->format('Y-m-d\TH:i:s\Z');
        }
        $this->layout = $layout;
        $this->duration = $duration;
        $this->createNotification = $createNotification;
        $this->updateNotification = $updateNotification;
    }

    public function getID() {
        return $this->id;
    }

    public function getData() {
        $createNotification = $this->createNotification ? $this->createNotification->getData() : null;
        $updateNotification = $this->updateNotification ? $this->updateNotification->getData() : null;

        return array_filter(['id' => $this->id, 'time' => $this->time, 'duration' => $this->duration, 'createNotification' => $createNotification, 'updateNotification' => $updateNotification, 'layout' => $this->layout->getData(), 'reminders' => $this->reminders, 'actions' => $this->actions]);
    }

    public function addReminder(PinReminder $reminder) {
        if (count($this->reminders) < 3) {
            array_push($this->reminders, $reminder->getData());

            return true;
        }

        return false;
    }

    public function addAction(PinAction $action) {
        array_push($this->actions, $action->getData());
    }

}

?>