<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'techvision_db');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SITE_URL', 'http://localhost/');
define('SITE_NAME', 'TechVision Solutions');
define('ADMIN_EMAIL', 'admin@techvision.com');

define('SESSION_LIFETIME', 3600);

define('ENABLE_DEBUG', true);
define('LOG_ERRORS', true);

if (ENABLE_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
