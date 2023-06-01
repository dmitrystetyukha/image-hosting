<?php
define("BASE_URI", 'http://' . $_SERVER['SERVER_NAME'] . ':8080');

const PICTURE_STORAGE_DIR = '/uploads/user_pictures/';

define("DB_HOST", $_ENV['DB_HOST']);
define("DB_NAME", $_ENV['DB_NAME']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASSWORD", $_ENV['DB_PASSWORD']);