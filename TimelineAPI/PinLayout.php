<?php

namespace TimelineAPI;

use DateTime;

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
    private $specialAttributes;

    function __construct($type, $title = null,
                         $shorttitle = null, $subtitle = null,
                         $body = null, $tinyicon = null,
                         $smallicon = null, $largeicon = null,
                         $foregroundcolour = null,
                         $backgroundcolour = null,
                         Array $headings = null, Array $paragraphs = null,
                         DateTime $lastupdated = null, Array $specialAttributes = null)
    {
        $this->type = $type;
        $this->title = $title;
        $this->shorttitle = $shorttitle;
        $this->subtitle = $subtitle;
        $this->body = $body;
        $this->tinyicon = $tinyicon;
        $this->smallicon = $smallicon;
        $this->largeicon = $largeicon;
        $this->foregroundcolour = $foregroundcolour;
        $this->backgroundcolour = $backgroundcolour;
        $this->headings = $headings;
        $this->paragraphs = $paragraphs;
        if ($lastupdated != null) {
            $this->lastupdated = $lastupdated -> format('Y-m-d\TH:i:s\Z');
        }
        if ($specialAttributes != null) {
            $this->specialAttributes = $specialAttributes;
        } else {
            $this-> specialAttributes = [];
        }

    }

    function getData()
    {
        return array_filter(array_merge(['type' => $this->type, 'title' => $this->title, 'shortTitle' => $this->shorttitle, 'subtitle' => $this->subtitle, 'body' => $this->body, 'tinyIcon' => $this->tinyicon, 'smallIcon' => $this->smallicon, 'largeIcon' => $this->largeicon, 'foregroundColor' => $this->foregroundcolour, 'backgroundColor' => $this->backgroundcolour, 'headings' => $this->headings, 'paragraphs' => $this->paragraphs, 'lastUpdated' => $this->lastupdated], $this -> specialAttributes));
    }

}

class PinLayoutType
{
    const
        GENERIC_PIN = 'genericPin',
        CALENDAR_PIN = 'calendarPin',
        GENERIC_REMINDER = 'genericReminder',
        GENERIC_NOTIFICATION = 'genericNotification',
        COMM_NOTIFICATION = 'commNotification',
        WEATHER_PIN = 'weatherPin',
        SPORTS_PIN = 'sportsPin';
}

class PinIcon
{

    const
        NOTIFICATION_GENERIC = 'system://images/NOTIFICATION_GENERIC',
        NOTIFICATION_REMINDER = 'system://images/NOTIFICATION_REMINDER',
        NOTIFICATION_FLAG = 'system://images/NOTIFICATION_FLAG',
        NOTIFICATION_FACEBOOK_MESSENGER = 'system://images/NOTIFICATION_FACEBOOK_MESSENGER',
        NOTIFICATION_WHATSAPP = 'system://images/NOTIFICATION_WHATSAPP',
        NOTIFICATION_GMAIL = 'system://images/NOTIFICATION_GMAIL',
        NOTIFICATION_FACEBOOK = 'system://images/NOTIFICATION_FACEBOOK',
        NOTIFICATION_GOOGLE_HANGOUTS = 'system://images/NOTIFICATION_GOOGLE_HANGOUTS',
        NOTIFICATION_TELEGRAM = 'system://images/NOTIFICATION_TELEGRAM',
        NOTIFICATION_TWITTER = 'system://images/NOTIFICATION_TWITTER',
        NOTIFICATION_GOOGLE_INBOX = 'system://images/NOTIFICATION_GOOGLE_INBOX',
        NOTIFICATION_MAILBOX = 'system://images/NOTIFICATION_MAILBOX',
        NOTIFICATION_OUTLOOK = 'system://images/NOTIFICATION_OUTLOOK',
        NOTIFICATION_INSTAGRAM = 'system://images/NOTIFICATION_INSTAGRAM',
        NOTIFICATION_BLACKBERRY_MESSENGER = 'system://images/NOTIFICATION_BLACKBERRY_MESSENGER',
        NOTIFICATION_LINE = 'system://images/NOTIFICATION_LINE',
        NOTIFICATION_SNAPCHAT = 'system://images/NOTIFICATION_SNAPCHAT',
        NOTIFICATION_WECHAT = 'system://images/NOTIFICATION_WECHAT',
        NOTIFICATION_VIBER = 'system://images/NOTIFICATION_VIBER',
        NOTIFICATION_SKYPE = 'system://images/NOTIFICATION_SKYPE',
        NOTIFICATION_YAHOO_MAIL = 'system://images/NOTIFICATION_YAHOO_MAIL',
        GENERIC_EMAIL = 'system://images/GENERIC_EMAIL',
        GENERIC_SMS = 'system://images/GENERIC_SMS',
        GENERIC_WARNING = 'system://images/GENERIC_WARNING',
        GENERIC_CONFIRMATION = 'system://images/GENERIC_CONFIRMATION',
        GENERIC_QUESTION = 'system://images/GENERIC_QUESTION',
        PARTLY_CLOUDY = 'system://images/PARTLY_CLOUDY',
        CLOUDY_DAY = 'system://images/CLOUDY_DAY',
        LIGHT_SNOW = 'system://images/LIGHT_SNOW',
        LIGHT_RAIN = 'system://images/LIGHT_RAIN',
        HEAVY_RAIN = 'system://images/HEAVY_RAIN',
        HEAVY_SNOW = 'system://images/HEAVY_SNOW',
        TIMELINE_WEATHER = 'system://images/TIMELINE_WEATHER',
        TIMELINE_SUN = 'system://images/TIMELINE_SUN',
        RAINING_AND_SNOWING = 'system://images/RAINING_AND_SNOWING',
        TIMELINE_MISSED_CALL = 'system://images/TIMELINE_MISSED_CALL',
        TIMELINE_CALENDAR = 'system://images/TIMELINE_CALENDAR',
        TIMELINE_SPORTS = 'system://images/TIMELINE_SPORTS',
        TIMELINE_BASEBALL = 'system://images/TIMELINE_BASEBALL',
        AMERICAN_FOOTBALL = 'system://images/AMERICAN_FOOTBALL',
        CRICKET_GAME = 'system://images/CRICKET_GAME',
        SOCCER_GAME = 'system://images/SOCCER_GAME',
        HOCKEY_GAME = 'system://images/HOCKEY_GAME',
        RESULT_DISMISSED = 'system://images/RESULT_DISMISSED',
        RESULT_DELETED = 'system://images/RESULT_DELETED',
        RESULT_MUTE = 'system://images/RESULT_MUTE',
        RESULT_SENT = 'system://images/RESULT_SENT',
        RESULT_FAILED = 'system://images/RESULT_FAILED',
        STOCKS_EVENT = 'system://images/STOCKS_EVENT',
        MUSIC_EVENT = 'system://images/MUSIC_EVENT',
        BIRTHDAY_EVENT = 'system://images/BIRTHDAY_EVENT',
        PAY_BILL = 'system://images/PAY_BILL',
        HOTEL_RESERVATION = 'system://images/HOTEL_RESERVATION',
        TIDE_IS_HIGH = 'system://images/TIDE_IS_HIGH',
        NEWS_EVENT = 'system://images/NEWS_EVENT',
        SCHEDULED_EVENT = 'system://images/SCHEDULED_EVENT',
        DURING_PHONE_CALL = 'system://images/DURING_PHONE_CALL',
        CHECK_INTERNET_CONNECTION = 'system://images/CHECK_INTERNET_CONNECTION',
        MOVIE_EVENT = 'system://images/MOVIE_EVENT',
        GLUCOSE_MONITOR = 'system://images/GLUCOSE_MONITOR',
        ALARM_CLOCK = 'system://images/ALARM_CLOCK',
        CAR_RENTAL = 'system://images/CAR_RENTAL',
        DINNER_RESERVATION = 'system://images/DINNER_RESERVATION',
        RADIO_SHOW = 'system://images/RADIO_SHOW',
        AUDIO_CASSETTE = 'system://images/AUDIO_CASSETTE',
        SCHEDULED_FLIGHT = 'system://images/SCHEDULED_FLIGHT',
        NO_EVENTS = 'system://images/NO_EVENTS',
        REACHED_FITNESS_GOAL = 'system://images/REACHED_FITNESS_GOAL',
        DAY_SEPARATOR = 'system://images/DAY_SEPARATOR',
        WATCH_DISCONNECTED = 'system://images/WATCH_DISCONNECTED',
        TV_SHOW = 'system://images/TV_SHOW';

}

class PebbleColour
{
    const
        BLACK = '#000000',
        WHITE = '#FFFFFF',
        LIGHT_GREY = '#AAAAAA',
        DARK_GREY = '#555555',
        PASTEL_YELLOW = '#FFFAA',
        ICTERINE = '#FFF55',
        RAJAH = '#FFAA55',
        ORANGE = '#FF5500',
        RED = '#FF0000',
        FOLLY = '#FF0055',
        SUNSET_ORNAGE = '#FF5555',
        MELON = '#FFAAAA',
        YELLOW = '#FFFF00',
        CHROME_YELLOW = '#FFAA00',
        WINDSOR_TAN = '#AA5500',
        ROSE_VALE = '#AA5555',
        DARK_CANDY_APPLE_RED = '#AA0000',
        FASHION_MAGENTA = '#FF00AA',
        BRILLIANT_ROSE = '#FF55AA',
        RICH_BRILLIANT_LAVENDER = '#FFAAFF',
        LIMERICK = '#AAAA00',
        BULGERIAN_ROSE = '#550000',
        JAZZBERRY_JAM = '#AA0055',
        MAGENTA = '#FF00FF',
        SHOCKING_PINK = '#FF55FF',
        BRASS = '#AAAA55',
        ARMY_GREEN = '#555500',
        IMPERIAL_PURPLE = '#550055',
        PURPLE = '#AA00AA',
        PURPURES = '#AA55AA',
        KELLY_GREEN = '#55AA00',
        DARK_GREEN = '#005500',
        MIDNIGHT_GREEN = '#005555',
        OXFORD_BLUE = '#000055',
        INDIGO = '#5500AA',
        VIVID_VIOLET = '#AA00FF',
        LAVANDER_INDIGO = '#AA55FF',
        INCHWORM = '#AAFF55',
        SPRING_BUD = '#AAFF00',
        BRIGHT_GREEN = '#55FF00',
        GREEN = '#00FF00',
        ISLAMIC_GREEN = '#00AA00',
        MAY_GREEN = '#55AA55',
        CADET_BLUE = '#55AAAA',
        COBALT_BLUE = '#0055AA',
        DARK_BLUE = '#0000AA',
        ELECTRIC_ULTRAMARINE = '#5500FF',
        LIBERTY = '#5555AA',
        MINT_GREEN = '#AAFFAA',
        SCREAMIN_GREEN = '#55FF55',
        MALACHITE = '#00FF55',
        JAEGER_GREEN = '#00AA55',
        TIFFANY_BLUE = '#00AAAA',
        VIVID_CERULEAN = '#00AAFF',
        BLUE = '#0000FF',
        VERY_LIGHT_BLUE = '#5555FF',
        BABY_BLUE_EYES = '#AAAAFF',
        MEDIUM_AQUAMARINE = '#55FFAA',
        MEDIUM_SPRING_GREEN = '#00FFAA',
        CYAN = '#00FFFF',
        PICTON_BLUE = '#55AAFF',
        BLUE_MOON = '#0055FF',
        ELECTRIC_BLUE = '#55FFFF',
        CELESTE = '#AAFFFF';
}