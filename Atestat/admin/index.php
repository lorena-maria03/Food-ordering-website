<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<!-- CONȚINUT -->
<div class="main-content" style="height: 72%;">
    <div class="wrapper">
        <div style="color: green; font: 25px;">
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
        </div>
        <br><br>
        <h1>Panou Control</h1>
        <br><br>
        <a href="manage-category.php" style="text-decoration: none; color: black;"><div class="col-4 text-center">
            <?php
                $sql = "SELECT * FROM category";
                $result = mysqli_query($connection, $sql);
                $nr = mysqli_num_rows($result);
            ?>
            <h1 style="color: #70a1ff;"><?php echo $nr; ?></h1>
            Categorii
        </div></a>

        <a href="manage-food.php" style="text-decoration: none; color: black;"><div class="col-4 text-center">
            <?php
                $sql = "SELECT * FROM food";
                $result = mysqli_query($connection, $sql);
                $nr = mysqli_num_rows($result);
            ?>
            <h1 style="color: #eccc68;"><?php echo $nr; ?></h1>
            Mâncare
        </div></a>

        <a href="manage-order.php" style="text-decoration: none; color: black;"><div class="col-4 text-center">
            <?php
                $sql = "SELECT * FROM `order` WHERE status='Comandat'";
                $result = mysqli_query($connection, $sql);
                $nr = mysqli_num_rows($result);
            ?>
            <h1 style="color: #ff4757;"><?php echo $nr; ?></h1>
            Comenzi noi
        </div></a>
   
        <div class="col-4 text-center">
            <?php
                $sql = "SELECT * FROM `order` WHERE status='Finalizat'";
                $result = mysqli_query($connection, $sql);
                $total_revenue = 0;
                while ($row = mysqli_fetch_assoc($result))
                    $total_revenue += $row['total'];   
            ?>
            <h1 style="color: #2ed573;"><?php echo $total_revenue; ?>.00 lei</h1>
            Total
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>