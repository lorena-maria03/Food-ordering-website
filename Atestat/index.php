<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials-front/menu.php'); ?>

<!-- Search Bar -->
<section class="food-search text-center">
    <div class="container">
        <form action="food-search.php" method="POST">
            <input type="search" name="search" required>
            <input type="submit" name="submit" value="Caută" class="btn btn-primary">
        </form>
    </div>
</section>

<!-- Categorii -->
<section class="categories">
    <div class="container">
        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
        <h2 class="text-center">Explorează</h2>

        <?php
            $sql = "SELECT * FROM category WHERE active='Da' AND featured='Da'";
            $result = mysqli_query($connection, $sql);
            $nr = mysqli_num_rows($result);
            if($nr > 0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image = $row['image'];
                    ?>

                    <a href="category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image=="")
                                {
                                    echo "<div>Imaginea nu este disponibilă</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo HOME; ?>images/category/<?php echo $image; ?>" 
                                    class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            <h3 class="float-text text-white" style="-webkit-text-stroke: 1px black;"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
        ?>

        <div class="clearfix"></div>
        <p class="text-center">
        <a href="categories.php">Vezi toate categoriile</a>
    </p>
    </div>
</section>


<!-- Meniu mâncare -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Meniu</h2>

        <?php
            $sql = "SELECT * FROM food WHERE active='Da' AND featured='Da'";
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
    <p class="text-center">
        <a href="foods.php">Vezi tot</a>
    </p>
</section>

<!-- FOOTER -->
<?php include('partials-front/footer.php'); ?>