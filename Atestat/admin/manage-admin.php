<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1>Panou admin</h1>
        <br>
        <?php
            if(isset($_SESSION['add-admin']))
            {
                echo $_SESSION['add-admin'];
                unset($_SESSION['add-admin']);
            }
            if(isset($_SESSION['delete-admin']))
            {
                echo $_SESSION['delete-admin'];
                unset($_SESSION['delete-admin']);
            }
            if(isset($_SESSION['update-admin']))
            {
                echo $_SESSION['update-admin'];
                unset($_SESSION['update-admin']);
            }
            if(isset($_SESSION['change-password']))
            {
                echo $_SESSION['change-password'];
                unset($_SESSION['change-password']);
            }
            if(isset($_SESSION['no-admin']))
            {
                echo $_SESSION['no-admin'];
                unset($_SESSION['no-admin']);
            }
        ?>

        <br><br>

        <a href="add-admin.php" class="btn-primary">Adaugă admin</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>Nr</th>
                <th>Nume</th>
                <th>Utilizator</th>
                <th>Operații</th>
            </tr>

            <?php

                $sql = "SELECT * FROM `admin` ORDER BY name";
                $result = mysqli_query($connection, $sql);
                $cnt = mysqli_num_rows($result);
                $nr = 1;
                while($rows=mysqli_fetch_assoc($result))
                {
                    $name = $rows['name'];
                    $username = $rows['username'];
                    $id = $rows['id'];
                    ?>

                        <tr>
                            <td><?php echo $nr++; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo HOME;?>admin/change-password.php?id=<?php echo $id; ?>" 
                                    class="btn-primary">Schimbă parola</a>
                                <a href="<?php echo HOME;?>admin/update-admin.php?id=<?php echo $id; ?>" 
                                    class="btn-green">Actualizează adminul</a>
                                <a href="<?php echo HOME;?>admin/delete-admin.php?id=<?php echo $id; ?>" 
                                    class="btn-delete">Șterge adminul</a>
                            </td>
                        </tr>

                    <?php

                }
            ?>

        </table>

    </div>
</div>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>