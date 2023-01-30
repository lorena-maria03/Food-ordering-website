<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>

<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1>Panou comenzi</h1>
        <br>
        <?php
            if(isset($_SESSION['no-order']))
            {
                echo $_SESSION['no-order'];
                unset($_SESSION['no-order']);
            }
            if(isset($_SESSION['update-order']))
            {
                echo $_SESSION['update-order'];
                unset($_SESSION['update-order']);
            }
        ?>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>Nr</th>
                <th>Data</th>
                <th>Comanda</th>
                <th>Total</th>
                <th>Status</th>
                <th>Client</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Adresă</th>
                <th>Operații</th>
            </tr>

            <?php

                $sql = "SELECT * FROM `order` ORDER BY order_date desc";
                $result = mysqli_query($connection, $sql);
                $nr = 1;
                if($result==TRUE)
                {
                    $cnt = mysqli_num_rows($result);
                    if($cnt > 0)
                        {
                            while($rows=mysqli_fetch_assoc($result))
                            {
                                $id = $rows['id'];
                                $food = $rows['food'];
                                $price = $rows['price'];
                                $quantity = $rows['quantity'];
                                $total = $rows['total'];
                                $order_date = $rows['order_date'];
                                $status = $rows['status'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact = $rows['customer_contact'];
                                $customer_email = $rows['customer_email'];
                                $customer_address = $rows['customer_address'];
                                ?>

                                <tr>
                                    <td><?php echo $nr++; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $food; ?>(<?php echo$quantity; ?>)</td>
                                    <td><?php echo $total; ?></td>
                                    <?php
                                        if($status=="Comandat")
                                        {
                                            ?>
                                                <td style="color: #ff4757"><?php echo $status; ?></td>
                                            <?php
                                        }
                                        else if($status=="Livrare")
                                        {
                                            ?>
                                                <td style="color: #ffa502"><?php echo $status; ?></td>
                                            <?php
                                        }
                                        else if($status=="Finalizat")
                                        {
                                            ?>
                                                <td style="color: #03a54f"><?php echo $status; ?></td>
                                            <?php 
                                        }
                                        else if($status=="Anulat")
                                        {
                                            ?>
                                                <td style="color: #57606f"><?php echo $status; ?></td>
                                            <?php
                                        }
                                    ?>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td><a href="<?php echo HOME;?>admin/update-order.php?id=<?php echo $id;?>" 
                                            class="btn-green">Actualizează comanda</a></td>
                                </tr>

                                <?php
                            }   
                        } 
                    else
                    {
                        ?>
                        <tr>
                            <td>
                                <div style="color: red; font: 25px;" colspan="6">Nicio comandă.</div>
                            </td>
                        </tr>
                        <?php 
                    }  
                }
            ?>


            
        </table>

    </div>
</div>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>