<?php


class PinNotification {

    private $layout;
    private $time;

   function __construct(PinLayout $layout, $time = null) {
        $this -> layout = $layout;
        $this -> time = $time;
    }

}