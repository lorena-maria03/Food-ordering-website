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
        $sql = "SELECT * FROM `category` WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $cnt = mysqli_num_rows($result);
            if($cnt == 1)
            {
                $nr=mysqli_fetch_assoc($result);
                $title = $nr['title'];
                $current_image = $nr['image'];
                $featured = $nr['featured'];
                $active = $nr['active'];
            }
            else
            {
                $_SESSION['no-category'] = "<div class='error'>Categoria nu a fost găsită.</div>";
                header("location: http://localhost/ATESTAT/admin/manage-category.php");
            }
        }
    }
    else header("location:http://localhost/ATESTAT/admin/manage-category.php");

?>

<!-- CONȚINUT -->

<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Actualizare categorie</h1>
        <br>
        <?php
            if(isset($_SESSION['update-category']))
                {
                    echo $_SESSION['update-category'];
                    unset($_SESSION['update-category']);
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
                    <td>Imagine actuală</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo HOME; ?>images/category/<?php echo $current_image; ?>" width=150px;>
                                <?php
                            }
                            else echo "<div class='error' style='text-align: left'>Fără imagine.</div>";
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
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="Da") echo "checked"; ?> type="radio" name="active" value="Da">Da
                        <input <?php if($active=="Nu") echo "checked"; ?> type="radio" name="active" value="Nu">Nu
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Da") echo "checked"; ?> type="radio" name="featured" value="Da">Da
                        <input <?php if($featured=="Nu") echo "checked"; ?> type="radio" name="featured" value="Nu">Nu
                    </td>
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
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        
        if(isset($_FILES['image']['name']))
        {
            $image = $_FILES['image']['name'];
            if($image != "")
            {
                $extension = end(explode('.', $image));
                $time = date("d-m-Y")."-".time();
                $image = "food_category_".$time.'.'.$extension;

                $source = $_FILES['image']['tmp_name'];
                $destination = "../images/category/".$image;

                $upload = move_uploaded_file($source, $destination);

                if($upload==FALSE)
                {
                    $_SESSION['upload'] = "<div class='error'>EROARE. Imaginea nu a fost găsită.</div>";
                    header("Location:http://localhost/ATESTAT/admin/manage-category.php");
                    die();
                }
                
                if($current_image!="")
                {
                    $path = "../images/category/".$current_image;
                    $remove = unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['remove-failed']="<div class='error'>EROARE. Imaginea actuală nu a fost ștearsă.</div>";
                        header("Location:http://localhost/ATESTAT/admin/manage-category.php");
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
        
        $sql = "UPDATE `category` SET
                title='$title',
                image='$image',
                featured='$featured',
                active='$active'
                WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        if($result==TRUE)
        {
            $_SESSION['update-category'] = "<div class='success'>Categoria a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/manage-category.php");
        }
        else
        {
            $_SESSION['update-category'] = "<div class='error'>EROARE. Categoria nu a fost actualizată.</div>";
            header("location:http://localhost/ATESTAT/admin/update-category.php?id=$id");
        }

    }

?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>