<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1>Panou categorii</h1>
        <br>
        <?php
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['delete-category']))
            {
                echo $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
            }
            if(isset($_SESSION['update-category']))
            {
                echo $_SESSION['update-category'];
                unset($_SESSION['update-category']);
            }
            if(isset($_SESSION['no-category']))
            {
                echo $_SESSION['no-category'];
                unset($_SESSION['no-category']);
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
        ?>

        <br><br>

        <a href="add-category.php" class="btn-primary">Adaugă categorie</a>

        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>Imagine</th>
                <th>Titlu</th>
                <th>Activ</th>
                <th>Featured</th>
                <th>Operații</th>
            </tr>

            <?php

                $sql = "SELECT * FROM `category` ORDER BY title";
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
                                $image = $rows['image'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                ?>

                                <tr>
                                    <td>
                                        <?php
                                            if($image != "")
                                            {
                                                ?>
                                                <img src="<?php echo HOME;?>images/category/<?php echo $image;?>"
                                                width="100px">
                                                <?php
                                            }
                                            else echo "<div class='error' style='text-align: left;'>Fără imagine</div>";
                                            ?>
                                    </td>
                                    <td><?php echo $title; ?></td>
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
                                        <a href="<?php echo HOME;?>admin/update-category.php?id=<?php echo $id;?>" 
                                            class="btn-green">Actualizează categoria</a>
                                        <a href="<?php echo HOME;?>admin/delete-category.php?id=<?php echo $id;?>&image=<?php echo $image;?>" 
                                            class="btn-delete">Șterge categoria</a>
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
                                <div style="color: red; font: 25px;" colspan="6">Nicio categorie adăugată.</div>
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