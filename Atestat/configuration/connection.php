<?php
    header('Content-type: text/html; charset=UTF-8');
    
    define('HOME', 'http://localhost/ATESTAT/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($connection, DB_NAME) or die(mysqli_error());

?>
