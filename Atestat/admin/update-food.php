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
        $sql = "SELECT * FROM `food` WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $cnt = mysqli_num_rows($result);
            if($cnt == 1)
            {
                $nr=mysqli_fetch_assoc($result);
                $title = $nr['title'];
                $description = $nr['description'];
                $price = $nr['price'];
                $current_image = $nr['image'];
                $current_category = $nr['category_id'];
                $featured = $nr['featured'];
                $active = $nr['active'];
            }
            else
            {
                $_SESSION['no-food'] = "<div class='error'>Mâncarea nu a fost găsită.</div>";
                header("location: http://localhost/ATESTAT/admin/manage-food.php");
            }
        }
    }
    else header("location:http://localhost/ATESTAT/admin/manage-food.php");

?>

<!-- CONȚINUT -->

<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Actualizare mâncare</h1>
        <br>
        <?php
            if(isset($_SESSION['update-food']))
                {
                    echo $_SESSION['update-food'];
                    unset($_SESSION['update-food']);
                }
        ?>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titlu</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Descriere</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Preț</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Imagine actuală</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo HOME; ?>images/food/<?php echo $current_image; ?>" width=150px;>
                                <?php
                            }
                            else echo "<div class='error' style='text-align: left'>Fără imagine</div>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Imagine nouă</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Categorie</td>
                    <td>
                        <select name="category_id">
                            <?php
                                $sql = "SELECT * FROM category";
                                $result = mysqli_query($connection, $sql);
                                $cnt = mysqli_num_rows($result);
                                if($cnt > 0)
                                {
                                    while($rows=mysqli_fetch_assoc($result))
                                    {
                                        $category_title = $rows['title'];
                                        $category_id = $rows['id'];
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?>
                                         value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0"></option>
                                    <?php
                                }
                                ?>
                        </select>
                    </td>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($active=="Da") echo "checked"; ?> type="radio" name="active" value="Da">Da
                        <input <?php if($active=="Nu") echo "checked"; ?> type="radio" name="active" value="Nu">Nu
                    </td>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured=="Da") echo "checked"; ?> type="radio" name="featured" value="Da">Da
                            <input <?php if($featured=="Nu") echo "checked"; ?> type="radio" name="featured" value="Nu">Nu
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Actualizează" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>
        <br>
    </div>
</div>

<?php

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category_id = $_POST['category_id'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        if(isset($_FILES['image']['name']))
        {
            $image = $_FILES['image']['name'];
            if($image != "")
            {
                $extension = end(explode('.', $image));
                $time = date("d-m-Y")."-".time();
                $image = "food_name_".$time.'.'.$extension;

                $source = $_FILES['image']['tmp_name'];
                $destination = "../images/food/".$image;

                $upload = move_uploaded_file($source, $destination);

                if($upload==FALSE)
                {
                    $_SESSION['upload'] = "<div class='error'>EROARE. Imaginea nu a fost găsită.</div>";
                    header("Location:http://localhost/ATESTAT/admin/manage-food.php");
                    die();
                }
                
                if($current_image!="")
                {
                    $path = "../images/food/".$current_image;
                    $remove = unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['remove-failed']="<div class='error'>EROARE. Imaginea actuală nu a fost ștearsă.</div>";
                        header("Location:http://localhost/ATESTAT/admin/manage-food.php");
                        die();
                    }
                }
            }
            else
            {
                $image = $current_image;
            }
        }
        else
        {
            $image = $current_image;
        }
        
        $sql="UPDATE `food` SET
                title='$title',
                description='$description',
                price=$price,
                category_id=$category_id,
                image='$image',
                featured='$featured',
                active='$active'
                WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $_SESSION['update-food'] = "<div class='success'>Mâncarea a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/manage-food.php");
        }
        else
        {
            $_SESSION['update-food'] = "<div class='error'>EROARE. Mâncarea nu a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/update-food.php?id=$id");
        }

    }

?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>