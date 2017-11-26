<?php
defined('DB_HOST') or define('DB_HOST', 'localhost');
defined('DB_USER') or define('DB_USER', 'fulltemplate');
defined('DB_PASS') or define('DB_PASS', '123FullTemplate');
defined('DB_NAME') or define('DB_NAME', 'fulltemplate');
defined('SEND_ERRORS_TO') or define('SEND_ERRORS_TO', 'cairnswm@gmail.com');
defined('DISPLAY_DEBUG') or define('DISPLAY_DEBUG', true);
require_once( 'class.db.php' );
$database = new DB();
?>