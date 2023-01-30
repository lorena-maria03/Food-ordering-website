<?php
ob_start();
session_start();
?>

<?php include('../configuration/connection.php'); ?>

<?php
    session_destroy();
    header("location: http://localhost/ATESTAT/admin/login.php");
?>