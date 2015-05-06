<?php ini_set('display_errors', 1); ?>

<?php

require_once 'TimelineAPI/Pin.php';

use TimelineAPI\Pin;
use TimelineAPI\PinLayout;
use TimelineAPI\PinLayoutType;
use TimelineAPI\PinIcon;

error_reporting (E_ALL);

$layout = new PinLayout(PinLayoutType::GENERIC_PIN, 'News at 6\'Oclock', null, null, null, PinIcon::NOTIFICATION_FLAG);

$pin = new Pin('text-pin-1', new DateTime('now'), $layout);

echo json_encode($pin -> getData(), JSON_UNESCAPED_SLASHES);

//echo json_encode($timeline -> listSubscriptions(''));

?>