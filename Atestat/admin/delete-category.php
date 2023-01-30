<?php
ob_start();
session_start();
?>
<?php
    include ('../configuration/connection.php');
    if(isset($_GET['id']) AND isset($_GET['image']))
    {
        $id = $_GET['id'];
        $image = $_GET['image'];

        $sql = "SELECT * FROM `category` WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $cnt = mysqli_num_rows($result);

        if($cnt != 1)
        {
            $_SESSION['no-category'] = "<div class='error'>Categoria nu a fost găsită.</div>";
            header("location: http://localhost/ATESTAT/admin/manage-category.php");
        }
        else
        {
            if($image != "")
            {
                $path = "../images/category/".$image;
                $remove = unlink($path);
            }
    
            $sql = "DELETE FROM `category` WHERE id=$id";
            $result = mysqli_query($connection, $sql);
    
            if($result==true)
            {
               $_SESSION['delete-category'] = "<div class='success'>Categoria a fost ștearsă.</div>";
               header("location: http://localhost/ATESTAT/admin/manage-category.php");
            } 
            else
            {
                $_SESSION['delete-category'] = "<div class='error'>EROARE.Categoria nu a fost ștearsă.</div>";
                header("location: http://localhost/ATESTAT/admin/manage-category.php");
            } 
        }

    }
    else header("location: http://localhost/ATESTAT/admin/manage-category.php");

?>