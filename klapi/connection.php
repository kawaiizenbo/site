<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'klapi');
define('DB_PASSWORD', 'L5kqdiKpferz2A');
define('DB_NAME', 'klapi');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if ($link == false)
{
    die(2);
}

?>
