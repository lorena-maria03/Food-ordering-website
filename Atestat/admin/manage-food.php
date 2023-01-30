<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1>Panou mâncare</h1>
        <br>
        <?php
            if(isset($_SESSION['add-food']))
            {
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
            if(isset($_SESSION['delete-food']))
            {
                echo $_SESSION['delete-food'];
                unset($_SESSION['delete-food']);
            }
            if(isset($_SESSION['update-food']))
            {
                echo $_SESSION['update-food'];
                unset($_SESSION['update-food']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['remove-failed']))
            {
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
            if(isset($_SESSION['no-food']))
            {
                echo $_SESSION['no-food'];
                unset($_SESSION['no-food']);
            }
        ?>

        <br><br>

        <a href="add-food.php" class="btn-primary">Adaugă mâncare</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>Categorie</th>
                <th>Imagine</th>
                <th>Titlu</th>
                <th>Preț</th>
                <th>Descriere</th>
                <th>Activ</th>
                <th>Featured</th>
                <th>Operații</th>
            </tr>

            <?php

                $sql = "SELECT * FROM `food` ORDER BY category_id, title";
                $result = mysqli_query($connection, $sql);
                if($result==TRUE)
                {
                    $cnt = mysqli_num_rows($result);
                    if($cnt > 0)
                        {
                            while($rows=mysqli_fetch_assoc($result))
                            {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image = $rows['image'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                $category_id = $rows['category_id'];

                                $sql2 = "SELECT * FROM `category` WHERE id=$category_id";
                                $result2 = mysqli_query($connection, $sql2);
                                $row2 = mysqli_fetch_assoc($result2);
                                $category_title = $row2['title'];
                                ?>

                                <tr>
                                    <td><?php echo $category_title; ?></td>
                                    <td>
                                        <?php
                                            if($image != "")
                                            {
                                                ?>
                                                <img src="<?php echo HOME;?>images/food/<?php echo $image;?>"
                                                width="100px">
                                                <?php
                                            }
                                            else echo "<div class='error' style='text-align: left;'>Fără imagine</div>";
                                            ?>
                                    </td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td style="max-width: 30px;"><?php echo $description; ?></td>
                                    <?php 
                                        if($active=="Da")
                                        {
                                            ?> <td style="color: #03a54f"><?php echo $active; ?></td>
                                            <?php
                                        }
                                        else if($active=="Nu")
                                        {
                                            ?> <td style="color: #ff4757;"><?php echo $active; ?></td>
                                            <?php
                                        }
                                        else { ?> <td><?php echo $active ?></td> <?php }
                                    ?>
                                    <?php 
                                        if($featured=="Da")
                                        {
                                            ?> <td style="color: #03a54f"><?php echo $featured; ?></td>
                                            <?php
                                        }
                                        else if($featured=="Nu")
                                        {
                                            ?> <td style="color: #ff4757;"><?php echo $featured; ?></td>
                                            <?php
                                        }
                                        else { ?> <td><?php echo $featured; ?></td> <?php }
                                    ?>
                                    <td>
                                        <a href="<?php echo HOME;?>admin/update-food.php?id=<?php echo $id;?>" 
                                            class="btn-green">Actualizează mâncarea</a><br><br>
                                        <a href="<?php echo HOME;?>admin/delete-food.php?id=<?php echo $id;?>&image=<?php echo $image;?>" 
                                            class="btn-delete">Șterge mâncarea</a>
                                    </td>
                            </tr>

                                <?php

                            }   
                        } 
                    else
                    {
                        ?>
                        <tr>
                            <td>
                                <div style="color: red; font: 25px;" colspan="6">Nicio mâncare adăugată.</div>
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