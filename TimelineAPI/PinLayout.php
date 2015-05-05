<?php

/**
 * Created by PhpStorm.
 * User: mattlanglois
 * Date: 15-05-04
 * Time: 7:35 PM
 */
class PinLayout
{

    private $type;
    private $title;
    private $shorttitle;
    private $subtitle;
    private $body;
    private $tinyicon;
    private $smallicon;
    private $largeicon;
    private $foregroundcolour;
    private $backgroundcolour;
    private $headings;
    private $paragraphs;
    private $lastupdated;

    function __construct(PinLayoutType $type, $title = null,
                         $shorttitle = null, $subtitle = null,
                         $body = null, PinIcon $tinyicon = null,
                         PinIcon $smallicon = null, PinIcon $largeicon = null,
                         PebbleColour $foregroundcolour = null,
                         PebbleColour $backgroundcolour = null,
                         Array $headings = null, Array $paragraphs,
                         DateTime $lastupdated = null, Array $specialAttributes)
    {
        $this -> type = $type;
        $this -> title = $title;
        $this -> shorttitle = $shorttitle;
        $this -> subtitle = $subtitle;
        $this -> body = $body;
        $this -> tinyicon = $tinyicon;
        $this -> smallicon = $smallicon;
        $this -> largeicon = $largeicon;
        $this -> foregroundcolour = $foregroundcolour;
        $this -> backgroundcolour = $backgroundcolour;
        $this -> headings = $headings;
        $this -> paragraphs = $paragraphs;
        $this -> lastupdated = $lastupdated;
    }

    function getData() {
    }

}