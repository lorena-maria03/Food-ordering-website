<?php
    if(!isset($_SESSION['user-active']))
    {
        $_SESSION['no-user-active']="<div class='error' style='margin-left: 50%;'>Conectează-te<br>înainte să accesezi<br>panoul de administrare.</div>";
        header("location:http://localhost/ATESTAT/admin/login.php");
    }
?>