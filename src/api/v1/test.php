<?php

echo json_encode([
    "status" => "success",
    "data" => [
        "name" => CONFIG['name'],
        "message" => "API is online!"
    ]
]);