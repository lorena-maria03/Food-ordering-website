<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials-front/menu.php'); ?>

<!-- Categorii -->
<section class="categories" style="background-color: #ececec;">
    <div class="container">
        <h2 class="text-center">Explorează</h2>

        <?php
            $sql = "SELECT * FROM category WHERE active='Da'";
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
            else
            {
                echo "<div>Nu există categorii.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>


<!-- FOOTER -->
<?php include('partials-front/footer.php'); ?>