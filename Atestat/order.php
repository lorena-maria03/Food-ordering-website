<?php
ob_start();
session_start();
?>
<!-- MENIU -->
<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['food_id']))
    {
        $id = $_GET['food_id'];
        $sql = "SELECT * FROM food WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $nr = mysqli_num_rows($result);
        if($nr == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $image = $row['image'];
            $price = $row['price'];
        }
        else header("location: index.php");
    }
    else header("location: index.php");
?>

<!-- Search Bar -->
<section class="food-search">
    <div class="container">

        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
        
        <h2 class="text-center text-white">Completează formularul pentru a comanda.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Mâncare selectată</legend>

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
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price"><?php echo $price; ?> lei </p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Cantitate</div>
                    <input type="number" name="quantity" class="input-responsive" value="1" min="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Detalii livrare</legend>
                <div class="order-label">Nume</div>
                <input type="text" name="full-name" class="input-responsive" required>

                <div class="order-label">Telefon</div>
                <input type="tel" name="contact" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" class="input-responsive" required>

                <div class="order-label">Adresa livrare</div>
                <textarea name="address" rows="3" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Comandă!" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $food = $_POST['food'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $price * $quantity;
                $order_date = date("Y-m-d H:i:s");
                $status = "Comandat";
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                $sql = "INSERT INTO `order` (food, price, quantity, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
                    VALUES ('$food', '$price', '$quantity', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address');";
                $result = mysqli_query($connection, $sql);
                if($result==true)
                {
                    $_SESSION['order'] = "<div style='text-align: center; color: #03a54f; font-size: 25px;'>Comanda a fost plasată.</div><br>";
                    header("location: index.php");
                }   
                else
                {
                    $_SESSION['order'] = "<div style='text-align: center;'><span style='color: #ff4757; background-color: white; font-size: 25px;'>Comanda nu a fost înregistrată.</span></div><br>";
                    header("location: order.php?food_id=$id");
                }  
            }
        ?>

    </div>
</section>

<!-- FOOTER -->
<?php include('partials-front/footer.php'); ?>