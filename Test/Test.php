<?php ini_set('display_errors', 1); ?>

<?php

//Include the timeline API
require_once '../TimelineAPI/Timeline.php';

//Import the required classes
use TimelineAPI\Pin;
use TimelineAPI\PinLayout;
use TimelineAPI\PinLayoutType;
use TimelineAPI\PinIcon;
use TimelineAPI\PinReminder;
use TimelineAPI\Timeline;
use TimelineAPI\PinAction;
use TimelineAPI\PinActionType;

$userToken = '<YOUR USER TOKEN HERE>';

//Create some layouts which our pin will use
$reminderlayout = new PinLayout(PinLayoutType::GENERIC_REMINDER, 'Sample reminder!', null, null, null, PinIcon::NOTIFICATION_FLAG);
$pinlayout = new PinLayout(PinLayoutType::GENERIC_PIN, 'Our title', null, null, null, PinIcon::NOTIFICATION_FLAG);

$pinAction = new PinAction('Open Action', 1, PinActionType::OPEN_WATCH_APP);

//Create a reminder which our pin will push before the event
$reminder = new PinReminder($reminderlayout, (new DateTime('now')) -> add(new DateInterval('PT10M')));

//Create the pin
$pin = new Pin('test-pin-' . intval(rand(0,10000)), (new DateTime('now')) -> add(new DateInterval('PT5M')), $pinlayout);

//Attach the reminder
$pin -> addReminder($reminder);
$pin -> addAction($pinAction);

echo 'RAW PIN DATA' . PHP_EOL;

echo json_encode($pin -> getData(), JSON_PRETTY_PRINT);

echo PHP_EOL;

echo 'Pin results' . PHP_EOL;

echo json_encode(Timeline::pushPin($userToken, $pin), JSON_PRETTY_PRINT);

echo 'User Topics' . PHP_EOL;

echo json_encode(Timeline::listSubscriptions($userToken));

?>