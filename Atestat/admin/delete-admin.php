<?php
 ob_start();
 session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<?php
    $id = $_GET['id'];
    $sql0 = "SELECT * FROM `admin` WHERE id=$id";
    $result0 = mysqli_query($connection, $sql0);
    if($result0==TRUE)
    {
        $cnt0 = mysqli_num_rows($result0);
        if($cnt0 == 1)
        {
            $nr0=mysqli_fetch_assoc($result0);
            $name = $nr0['name'];
            $username = $nr0['username'];
        }
        else
        {
            $_SESSION['no-admin'] = "<div class='error'>Adminul nu a fost găsit.</div>";
            header("location: http://localhost/ATESTAT/admin/manage-admin.php");
        }
    }
?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Ștergere utilizatorul <?php echo $name;?>(<?php echo $username;?>)</h1>

        <br>
        <?php
            if(isset($_SESSION['admin-password']))
            {
                echo $_SESSION['admin-password'];
                unset($_SESSION['admin-password']);
            }
        ?>
        <br>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Parola administrator</td>
                    <td><input type="password" name="password"></td>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Șterge" class="btn-delete" style="float: right;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $password = md5($_POST['password']);
        $sql1 = "SELECT * FROM admin WHERE username='admin'";
        $result1 = mysqli_query($connection, $sql1);
        if($result1==TRUE)
        {
            $nr1=mysqli_fetch_assoc($result1);
            $correct_password = $nr1['password'];
        }
        if($password==$correct_password)
        {
            $sql = "DELETE FROM `admin` WHERE id=$id";
            $result = mysqli_query($connection, $sql);
            if($result==TRUE)
            {
                $_SESSION['delete-admin'] = "<div class='success'>Adminul a fost șters.</div>";
                header("location:".HOME."admin/manage-admin.php");
            }
            else
            {
                $_SESSION['delete-admin'] = "<div class='error'>EROARE. Adminul nu a fost șters.</div>";
                header("location:".HOME."admin/manage-admin.php");
            }
        }
        else
        {
            $_SESSION['admin-password'] = "<div class='error'>Parola incorectă.</div>";
            header("location:".HOME."admin/delete-admin.php?id=$id");
        }
    }
?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>