<?php
ob_start();
session_start();
?>

<!-- MENIU -->
<?php include('partials/menu.php'); ?>


<!-- CONȚINUT -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="text-align: center;">Mâncare nouă</h1>
        <br>
        <?php
            if(isset($_SESSION['add-food']))
            {
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }
        ?>
        <br>

        <form actiob="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Titlu</td>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr>
                    <td>Descriere</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Preț</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Imagine</td>
                    <td><input type="file" name="image"></td>
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
                                        $category_id = $rows['id'];
                                        $category_title = $rows['title'];
                                        ?>
                                        <option value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Fără categorie</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
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
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
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
                $image = "food_name_".$time.'.'.$extension;
                $source = $_FILES['image']['tmp_name'];
                $destination = "../images/food/".$image;

                $upload = move_uploaded_file($source, $destination);

                if($upload==FALSE)
                {
                    $_SESSION['upload'] = "<div class='error'>EROARE. Nicio imagine.</div>";
                    header("Location:http://localhost/ATESTAT/admin/manage-food.php");
                    die();
                }
            }   
        }
        else
        {
            $image = "";
        }

        $sql = "INSERT INTO `food` (title, description, price, image, category_id, featured, active) 
                VALUES ('$title', '$description', $price, '$image', '$category_id', '$featured', '$active')
                ";

        $result = mysqli_query($connection, $sql);

        if($result==TRUE)
        {
            $_SESSION['add-food'] = "<div class='success'>Mâncarea a fost adăugată.</div>";
            header("Location:http://localhost/ATESTAT/admin/manage-food.php");
            exit;
        }
        else
        {
            $_SESSION['add-food'] = "<div class='error'>EROARE. Mâncarea nu a fost adăugată.</div>";
            header("Location:http://localhost/ATESTAT/admin/add-food.php");
            exit;
        }
    }
?>

<!-- FOOTER -->
<?php include('partials/footer.php'); ?>