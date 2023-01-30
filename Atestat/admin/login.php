<?php
ob_start();
session_start();
?>

<?php include('../configuration/connection.php'); ?>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    </head>

    <body>
        <div class="login" style="background-image: url(../images/food-logo.png); background-repeat: no-repeat;padding: 3% 0; height: 50%;">
            <h1 class="text-center" style="margin-left: 50%;">Intră în cont</h1>
            <br>
            <form method="POST" class="text-center" style="font-size: 23px; margin-left: 50%; margin-top: 5%">
                Utilizator
                <input type="text" name="username" style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" placeholder=" &#xf007"> <br><br>
                Parola 
                <input type="password" name="password" style="font-family: 'Font Awesome 5 Free'; font-weight: 700;" placeholder=" &#xf023"> <br><br>
                <input type="submit" name="submit" value="Conectează-te!" class="btn-primary" style='font-size: 17px; margin-top: 10;'>
            </form>
            <br>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-user-active']))
                {
                    echo $_SESSION['no-user-active'];
                    unset($_SESSION['no-user-active']);
                }
            ?>
        </div>
    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $sql);
        $cnt = mysqli_num_rows($result);
        if($cnt==1)
        {
            $_SESSION['login'] = "<div class='success' style='font-size: 25px;'>Bun venit, $username!</div>";
            $_SESSION['user-active'] = $username;
            header("Location:http://localhost/ATESTAT/admin/index.php");
        }
        else
        {
            $_SESSION['login'] = "<div class='error' style='margin-left: 50%;'>Utilizator sau parola incorecte</div>";
            header("Location:http://localhost/ATESTAT/admin/login.php");
        }
    }

?>

