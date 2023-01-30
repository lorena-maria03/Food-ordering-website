<?php include('../configuration/connection.php'); ?>
<?php include('../configuration/active.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administrare</title>
        <link rel="stylesheet" href = "../css/admin.css">
        <?php $uri = $_SERVER['REQUEST_URI']; ?>
    </head>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li>
                        <?php
                            if($uri=="/ATESTAT/admin/index.php")
                                echo "<a href='index.php' style='color: #ff4757; font-size: 19px;'>Acasă</a>";
                            else if($uri=="/ATESTAT/admin/")
                                echo "<a href='index.php' style='color: #ff4757; font-size: 19px;'>Acasă</a>";
                            else echo "<a href='index.php'>Acasă</a>";
                        ?>
                    </li>
                    <li>
                        <?php
                            if($uri=="/ATESTAT/admin/manage-admin.php")
                                echo "<a href='manage-admin.php' style='color: #ff4757; font-size: 19px;'>Admin</a>";
                            else echo "<a href='manage-admin.php'>Admin</a>";
                        ?>
                    </li>
                    <li>
                    <?php
                            if($uri=="/ATESTAT/admin/manage-category.php")
                                echo "<a href='manage-category.php' style='color: #ff4757; font-size: 19px;'>Categorii</a>";
                            else echo "<a href='manage-category.php'>Categorii</a>";
                        ?>
                    </li>
                    <li>
                        <?php
                            if($uri=="/ATESTAT/admin/manage-food.php")
                                echo "<a href='manage-food.php' style='color: #ff4757; font-size: 19px;'>Mâncare</a>";
                            else echo "<a href='manage-food.php'>Mâncare</a>";
                        ?>
                    </li>
                    <li>
                    <?php
                            if($uri=="/ATESTAT/admin/manage-order.php")
                                echo "<a href='manage-order.php' style='color: #ff4757; font-size: 19px;'>Comenzi</a>";
                            else echo "<a href='manage-order.php'>Comenzi</a>";
                        ?>
                    </li>
                    <li><button><a href="logout.php">Deconectează-te</a></button></li>
                </ul>
            </div>
        </div>
