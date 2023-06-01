<?php
require_once __DIR__ . '/repository/get-connection.php';
require_once __DIR__ . '/utils/session-maxlife.php';

ini_set('session.gc_maxlifetime', 3600);

session_start();

checkSessionLife();

$_SESSION['last_action'] = time();