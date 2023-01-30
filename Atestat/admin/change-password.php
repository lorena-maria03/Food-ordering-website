<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<!-- CONȚINUT -->

<div class="main-content">
    <div class="wrapper">
    <h1 style="text-align: center;">Schimbare parolă</h1>
    <br><br>
    <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM admin WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $cnt = mysqli_num_rows($result);
                if($cnt != 1)
                {
                    $_SESSION['no-admin'] = "<div class='error'>Adminul nu a fost găsit.</div>";
                    header("location: http://localhost/ATESTAT/admin/manage-admin.php");
                }
        }
    ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Parola actuală</td>
                <td><input type="password" name="current_password"></td>
            </tr>
            <tr>
                <td>Parola nouă</td>
                <td><input type="password" name="new_password"></td>
            </tr>
            <tr>
                <td>Confirmă parola</td>
                <td><input type="password" name="confirm_password"></td>
            </tr>
            <tr>
                 <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Schimbă parola" class="btn-green">
                </td>
            </tr>
        </table>

        <br>

        <?php
            if(isset($_SESSION['change-password']))
            {
                echo $_SESSION['change-password'];
                unset($_SESSION['change-password']);
            }
        ?>

    </form>

    </div>
</div>

<?php

    if($_POST['submit'])
    {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        $sql = "SELECT * FROM `admin` WHERE id=$id AND password='$current_password'";
        $result=mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $cnt = mysqli_num_rows($result);
            if($cnt == 1)
            {
                if($new_password == $confirm_password)
                {
                    $sql = "UPDATE `admin` SET
                            password='$new_password'
                            WHERE id='$id'";
                    $result = mysqli_query($connection, $sql);
                    if($result==TRUE)
                    {
                        $_SESSION['change-password'] = "<div class='success'>Parola a fost schimbată.</div>";
                        header("location: http://localhost/ATESTAT/admin/manage-admin.php");
                    }
                    else
                    {
                        $_SESSION['change-password'] = "EROARE. Parola nu a fost schimbată.";
                        header("location: http://localhost/ATESTAT/admin/manage-admin.php");
                    }
                }
                else
                {
                    $_SESSION['change-password'] = "<div class='error'>Parolele nu se potrivesc.</div>";
                    header("location: http://localhost/ATESTAT/admin/change-password.php?id=$id");
                }

            }
            else
            {
                $_SESSION['change-password'] = "<div class='error'>Parolă incorectă.</div>";
                header("location: http://localhost/ATESTAT/admin/change-password.php?id=$id");
            }
        }
    }

?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>