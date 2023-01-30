<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `order` WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $cnt = mysqli_num_rows($result);
            if($cnt == 1)
            {
                $nr = mysqli_fetch_assoc($result);
                $food = $nr['food'];
                $quantity = $nr['quantity'];
                $total = $nr['total'];
                $customer_name = $nr['customer_name'];
                $customer_contact = $nr['customer_contact'];
                $customer_email = $nr['customer_email'];
                $contact = $nr['contact'];
                $status = $nr['status'];
            }
            else
            {
                $_SESSION['no-order'] = "<div class='error'>Comanda nu a fost găsită.</div>";
                header("location: http://localhost/ATESTAT/admin/manage-order.php");
            }
        }
    }
    else header("location:http://localhost/ATESTAT/admin/manage-order.php");

?>

<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Actualizare comandă</h1>
        <br>
        <?php
            if(isset($_SESSION['update-order']))
                {
                    echo $_SESSION['update-order'];
                    unset($_SESSION['update-order']);
                }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Client</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><input type="tel" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Comanda</td>
                    <td><input name="food" value="<?php echo $food; ?>"></td>
                </tr>
                <tr>
                    <td>Cantitate</td>
                    <td><input name="quantity" value="<?php echo $quantity; ?>"></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><input type="total" name="total" value="<?php echo $total; ?>"></td>
                </tr>
                <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr>
                    <td style="font-size: 23px;">Status</td>
                    <td>
                        <select name="status" style="font-size: 19px;">
                            <option value="Comandat" <?php if($status=="Comandat"){echo "selected";} ?>>Comandat</option>
                            <option value="Livrare" <?php if($status=="Livrare"){echo "selected";} ?>>Livrare</option>
                            <option value="Finalizat" <?php if($status=="Finalizat"){echo "selected";} ?>>Finalizat</option>
                            <option value="Anulat" <?php if($status=="Anulat"){echo "selected";} ?>>Anulat</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Actualizează" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $food = $_POST['food'];
        $quantity = $_POST['quantity'];
        $total = $_POST['total'];
        $status = $_POST['status'];
        
        $sql="UPDATE `order` SET
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                food='$food',
                quantity='$quantity',
                total='$total',
                status='$status'
                WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $_SESSION['update-order'] = "<div class='success'>Comanda a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/manage-order.php");
        }
        else
        {
            $_SESSION['update-order'] = "<div class='error'>EROARE. Comanda nu a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/update-order.php?id=$id");
        }

    }

?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>