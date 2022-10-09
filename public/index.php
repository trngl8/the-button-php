<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$message = $_POST['message'];

header('Content-Type: application/json');

$data = [
    "id" => 1,
    "timestamp" => time(),
    "uri" => $uri,
    "weight" => 32
];

echo json_encode($data);
