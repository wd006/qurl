<?php
require $_SERVER['DOCUMENT_ROOT'] . '/init.php';

$routeObj = new Route();
$currentUrl = $routeObj->getRoute();

$pageObj = new Page();
$page = $pageObj->find($currentUrl);

if (strpos($currentUrl, '/api/v') === 0) {
    $api = new ApiHandler();
    $api->handle($currentUrl);
    exit;
}

if ($page) {
    $pageObj->serve($page);
    return;
} else {
    null;
}


$handler = new LinkHandler($currentUrl);
$result = $handler->getResult();


if (empty($result['shortname'])) {
    // http_response_code(404);
    // exit;
    null;
}

switch ($result['mode']) {
    case 'stats':
        echo "<h1>Link Stats</h1>";
        echo "Link: " . $result['shortname'] . "<br>";
        echo "Domain ID: " . $result['domain_id'];
        break;

    case 'preview':
        echo "<h1>Link Preview</h1>";
        echo "Link: " . $result['shortname'] . "<br>";
        echo "Domain ID: " . $result['domain_id'];
        break;

    case 'redirect':
        echo "<h1>Redirect</h1>";
        echo "Link: " . $result['shortname'] . "<br>";
        echo "Domain ID: " . $result['domain_id'];
        break;

    default:
        echo "Unknown mode";
}
