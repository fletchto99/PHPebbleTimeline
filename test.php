<?php

require_once 'TimelineAPI/Timeline.php';

use TimelineAPI\Pin;
use TimelineAPI\PinLayout;
use TimelineAPI\PinLayoutType;
use TimelineAPI\PinIcon;
use TimelineAPI\PinReminder;
use TimelineAPI\Timeline;

$reminder = new PinReminder(new PinLayout(PinLayoutType::GENERIC_PIN, 'News in 1 hour!', null, null, null, PinIcon::NOTIFICATION_FLAG), (new DateTime('now')) -> add(new DateInterval('PT10M')));
$pin = new Pin('text-pin-1', (new DateTime('now')) -> add(new DateInterval('PT5M')), new PinLayout(PinLayoutType::GENERIC_PIN, 'News at 6\'Oclock', null, null, null, PinIcon::NOTIFICATION_FLAG));
$pin -> addReminder($reminder);

echo json_encode($pin -> getData(), JSON_UNESCAPED_SLASHES);

Timeline::pushPin('ID', $pin);

?>