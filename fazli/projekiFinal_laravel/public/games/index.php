<?php

// Let Laravel handle /games instead of the server returning a directory 404.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = dirname(__DIR__).'/index.php';
unset($_SERVER['PATH_INFO']);

require dirname(__DIR__).'/index.php';
