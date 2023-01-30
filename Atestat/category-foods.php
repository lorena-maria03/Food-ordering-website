<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM category WHERE id=$category_id";
        $result = mysqli_query($connection, $sql);
        $nr = mysqli_num_rows($result);
        if($nr == 0) header("location: index.php");
        else
        {
            $row = mysqli_fetch_assoc($result);
            $category_title = $row['title'];
        }
    }
    else header("location: index.php");
?>


<!-- Search Bar -->
<section class="food-search text-center">
    <div class="container">
        <h2><a class="text-white"><?php echo $category_title; ?></a></h2>

    </div>
</section>

<!-- Meniu mâncare -->
<section class="food-menu">
    <div class="container">
        <?php
            $sql = "SELECT * FROM food WHERE category_id=$category_id AND active='Da' ORDER BY title";
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
            else echo"<div style='color: #ff4757; font-size: 20px;'>Momentan această categorie nu are preparate disponibile.</div>";
        ?>

        <div class="clearfix"></div>
    </div>
</section>


<!-- FOOTER -->
<?php include('partials-front/footer.php'); ?>