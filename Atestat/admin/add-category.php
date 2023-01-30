<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Categorie nouă</h1>

        <br>
        <?php
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['upload-category']))
            {
                echo $_SESSION['upload-category'];
                unset($_SESSION['upload-category']);
            }
        ?>
        <br>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titlu</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Imagine</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Da">Da
                        <input type="radio" name="featured" value="Nu">Nu
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Da">Da
                        <input type="radio" name="active" value="Nu">Nu
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adaugă" class="btn-green">
                    </td>
                </tr>
            </table>
        </form>



    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $title = $_POST['title'];

        if(isset($_POST['featured']))
            $featured = $_POST['featured'];
        else
            $featured = "Nu";

        if(isset($_POST['active']))
            $active = $_POST['active'];
        else
            $active = "Nu";

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
                    $_SESSION['upload-category'] = "<div class='error'>EROARE. Imaginea nu a fost găsită.</div>";
                    header("Location:http://localhost/ATESTAT/admin/manage-category.php");
                    die();
                }
            }   
        }
        else
        {
            $image = "";
        }

        $sql = "INSERT INTO `category` (title, featured, active, image) 
                VALUES ('$title', '$featured', '$active', '$image')
                ";

        $result = mysqli_query($connection, $sql);

        if($result==TRUE)
        {
            $_SESSION['add-category'] = "<div class='success'>Categoria a fost adăugată.</div>";
            header("Location:http://localhost/ATESTAT/admin/manage-category.php");
            exit;
        }
        else
        {
            $_SESSION['add-category'] = "<div class='error'>EROARE. Categoria nu a fost adăugată.</div>";
            header("Location:http://localhost/ATESTAT/admin/add-category.php");
            exit;
        }
        
    }
?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>