<?php ini_set('display_errors', 1); ?>

<?php

require_once 'TimelineAPI/Pin.php';

use TimelineAPI\Pin;
use TimelineAPI\PinLayout;
use TimelineAPI\PinLayoutType;
use TimelineAPI\PinIcon;
use TimelineAPI\PinReminder;

error_reporting (E_ALL);


$reminder = new PinReminder(new PinLayout(PinLayoutType::GENERIC_PIN, 'News in 1 hour!', null, null, null, PinIcon::NOTIFICATION_FLAG), (new DateTime('now')) -> sub(new DateInterval('PT1H')));
$pin = new Pin('text-pin-1', new DateTime('now'), new PinLayout(PinLayoutType::GENERIC_PIN, 'News at 6\'Oclock', null, null, null, PinIcon::NOTIFICATION_FLAG));
$pin -> addReminder($reminder);

echo json_encode($pin -> getData(), JSON_UNESCAPED_SLASHES);

//echo json_encode($timeline -> listSubscriptions(''));

?>