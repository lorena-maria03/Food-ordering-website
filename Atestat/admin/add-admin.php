<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Admin nou</h1>

        <br>
        <?php
            if(isset($_SESSION['add-admin']))
            {
                echo $_SESSION['add-admin'];
                unset($_SESSION['add-admin']);
            }
            if(isset($_SESSION['create-username']))
            {
                echo $_SESSION['create-username'];
                unset($_SESSION['create-username']);
            }
        ?>
        <br>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nume</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Utilizator</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Parolă</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adaugă" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>



    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql1 = "SELECT * FROM admin WHERE username='$username'";
        $result1 = mysqli_query($connection, $sql1);
        $cnt1 = mysqli_num_rows($result1);
        if($cnt1 == 0)
        {
            $sql = "INSERT INTO `admin` (name, username, password) 
                    VALUES ('$name', '$username', '$password')
                    ";
    
            $result = mysqli_query($connection, $sql);
    
            if($result==TRUE)
            {
                $_SESSION['add-admin'] = "<div class='success'>Adminul a fost adăugat</div>";
                header("Location:http://localhost/ATESTAT/admin/manage-admin.php");
                exit;
            }
            else
            {
                $_SESSION['add-admin'] = "<div class='error'>EROARE. Adminul nu a fost adăugat.</div>";
                header("Location:http://localhost/ATESTAT/admin/add-admin.php");
                exit;
            }
        }
        else
        {
            $_SESSION['create-username'] = "<div class='error'>EROARE. Acest username există deja.</div>";
            header("location:http://localhost/ATESTAT/admin/add-admin.php");
        }
    }
?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>