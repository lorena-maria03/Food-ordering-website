<?php include('configuration/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandă online!</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- NAVBAR -->
    <section>
        <div class="container">
            <div class="logo">
                <a title="Logo">
                    <img src="images/logo.jpg" class="img-responsive">
                </a>
            </div>
            <?php $uri = $_SERVER['REQUEST_URI']; ?>
            <div class="menu text-right">
                <ul>
                    <li>
                        <?php
                            if($uri=="/ATESTAT/index.php")
                                echo "<a href='index.php' style='color: #ff4757; font-size: 19px;'>Acasă</a>";
                            else if($uri=="/ATESTAT/")
                                echo "<a href='index.php' style='color: #ff4757; font-size: 19px;'>Acasă</a>";
                            else echo "<a href='index.php'>Acasă</a>";
                        ?>
                    </li>
                    <li>
                    <?php
                            if($uri=="/ATESTAT/categories.php")
                                echo "<a href='categories.php' style='color: #ff4757; font-size: 19px;'>Categorii</a>";
                            else echo "<a href='categories.php'>Categorii</a>";
                        ?>
                    </li>
                    <li>
                    <?php
                        if($uri=="/ATESTAT/foods.php")
                            echo "<a href='foods.php' style='color: #ff4757; font-size: 19px;'>Mâncare</a>";
                        else echo "<a href='foods.php'>Mâncare</a>";
                    ?>
                    </li>
                </ul>
            <div class="clearfix"></div>
        </div>
    </section>
