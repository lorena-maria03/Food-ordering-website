<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM `admin` WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    if($result==TRUE)
    {
        $cnt = mysqli_num_rows($result);
        if($cnt == 1)
        {
            $nr=mysqli_fetch_assoc($result);
            $name = $nr['name'];
            $username = $nr['username'];
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
        <h1 style="text-align: center;">Actualizare admin</h1>
        <form action="" method="POST">
            <br>
            <?php
                if(isset($_SESSION['update-admin']))
                    {
                        echo $_SESSION['update-admin'];
                        unset($_SESSION['update-admin']);
                    }
                if(isset($_SESSION['update-username']))
                    {
                        echo $_SESSION['update-username'];
                        unset($_SESSION['update-username']);
                    }
            ?>
            <br>
            <table class="tbl-30">
                <tr>
                    <td>Nume</td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Utilizator</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Actualizaeză" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if($_POST['submit'])
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];

        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($connection, $sql);
        $cnt = mysqli_num_rows($result);
        if($cnt == 0)
        {
            $sql2 = "UPDATE `admin` SET
                    name='$name',
                    username='$username'
                    WHERE id='$id'";
            $result2 = mysqli_query($connection, $sql2);
            if($result2==TRUE)
            {
                $_SESSION['update-admin'] = "<div class='success'>Adminul a fost actualizat.</div>";
                header("location:http://localhost/ATESTAT/admin/manage-admin.php");
            }
            else
            {
                $_SESSION['update-admin'] = "<div class='error'>EROARE. Adminul nu a fost actualizat.</div>";
                header("location:http://localhost/ATESTAT/admin/update-admin.php?id=$id");
            }
        }
        else
        {
            $_SESSION['update-username'] = "<div class='error'>EROARE. Acest username există deja.</div>";
            header("location:http://localhost/ATESTAT/admin/update-admin.php?id=$id");
        }

    }

?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>