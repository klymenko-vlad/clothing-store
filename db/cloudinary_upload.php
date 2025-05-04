<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use Cloudinary\Cloudinary;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => $_ENV['CLOUDINARY_NAME'],
        'api_key' => $_ENV['CLOUDINARY_KEY'],
        'api_secret' => $_ENV['CLOUDINARY_SECRET'],
    ],
]);

return $cloudinary;