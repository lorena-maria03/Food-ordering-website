<?php
ob_start();
session_start();
?>
<!-- MENIU -->
<?php include('partials-front/menu.php'); ?>

<!-- Search Bar-->
<section class="food-search text-center">
    <div class="container">
        
        <form action="food-search.php" method="POST">
            <input type="search" name="search" required>
            <input type="submit" name="submit" value="Caută" class="btn btn-primary">
        </form>

    </div>
</section>

<!-- Meniu mâncare -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Meniu</h2>

        <?php
            $sql = "SELECT * FROM food WHERE active='Da' ORDER BY title";
            $result = mysqli_query($connection, $sql);
            $nr = mysqli_num_rows($result);
            if($nr > 0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image = $row['image'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image=="")
                                {
                                    echo "<div>Imaginea nu este disponibilă</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo HOME; ?>images/food/<?php echo $image; ?>" 
                                    class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>
            
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?> lei</p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>
            
                            <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Comandă acum!</a>
                        </div>
                    </div>

                    <?php
                }
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<!-- FOOTER -->
<?php include('partials-front/footer.php'); ?>