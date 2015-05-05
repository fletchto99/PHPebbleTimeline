<?php

class PinLayoutType extends SplEnum
{
    const
        __default = self::GENERIC_PIN,
        GENERIC_PIN = 'genericPin',
        CALENDAR_PIN = 'calendarPin',
        GENERIC_REMINDER = 'genericReminder',
        GENERIC_NOTIFICATION = 'genericNotification',
        COMM_NOTIFICATION = 'commNotification',
        WEATHER_PIN = 'weatherPin',
        SPORTS_PIN = 'sportsPin';
}