<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST)) {
    echo Response::error(400, "Invalid request method.", "The server requires a POST request for this endpoint.");
    exit;
}

$shortlinkObj = new Shortlink();
echo $shortlinkObj->create($_POST);

exit;
