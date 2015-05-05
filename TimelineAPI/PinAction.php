<?php


class PinAction {

    private $title;
    private $launchcode;

    function __construct($title, $launchcode = null) {
        $this -> title = $title;
        $this -> launchcode = $launchcode;
    }

    function getLaunchCode() {
        return $this -> launchcode;
    }

    function getTitle() {
        return $this -> title;
    }

}