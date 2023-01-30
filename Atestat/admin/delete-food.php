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
        $sql = "SELECT * FROM `food` WHERE id='$id'";
        $result = mysqli_query($connection, $sql);
        $cnt = mysqli_num_rows($result);

        if($cnt != 1)
        {
            $_SESSION['no-food'] = "<div class='error'>Mâncarea nu a fost găsită.</div>";
            header("location: http://localhost/ATESTAT/admin/manage-food.php");
        }
        else
        {
            if($image != "")
            {
                $path = "../images/food/".$image;
                $remove = unlink($path);
            }
    
            $sql = "DELETE FROM `food` WHERE id='$id'";
            $result = mysqli_query($connection, $sql);
    
            if($result==true)
            {
               $_SESSION['delete-food'] = "<div class='success'>Mâncarea a fost ștearsă.</div>";
               header("location: http://localhost/ATESTAT/admin/manage-food.php");
            } 
            else
            {
                $_SESSION['delete-food'] = "<div class='error'>EROARE. Mâncarea nu a fost ștearsă.</div>";
                header("location: http://localhost/ATESTAT/admin/manage-food.php");
            } 
        }
    }
    else header("location: http://localhost/ATESTAT/admin/manage-food.php");

?>