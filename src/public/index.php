<?php

require_once __DIR__ . '/../lib/vendor/autoload.php';

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

if(!isset($_GET['userAgent'])) {
    http_response_code(400);
}

$userAgent = $_GET['userAgent'];

$dd = new DeviceDetector($userAgent);
$dd->parse();

header('Content-Type: application/json');

$reply = [
    'isMobile' => $dd->isMobile(),
    'isSmartphone' => $dd->isSmartPhone(),
    'isTablet' => $dd->isTablet(),
    'isDesktop' => $dd->isDesktop(),
    'os' => $dd->getOs('name'),
    'browser' => $dd->getClient('name'),
    'brand' => $dd->getBrandName(),
    'model' => $dd->getModel(),
];

echo json_encode($reply);
