<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if(isset($_POST['peta_cat']))
    {
        $sub_cat = $_POST['sub_cat'];
        $petasub_cat = $_POST['petasubname'];
 
            $resulth = mysqli_query($conn, "SELECT MAX(petasub_cat_id) as last_id FROM petasub_category");
            $rowh = mysqli_fetch_assoc($resulth);
            $last_id = $rowh['last_id'];
            
            $next_id = $last_id + 1;
            
            $insert_main = "INSERT INTO `petasub_category`(`petasub_cat_id`, `sub_cat_id`, `petasub_cat_name`) VALUES ('$next_id','$sub_cat','$petasub_cat')";
            $insert_result = mysqli_query($conn, $insert_main);       
            if($insert_main)
            {
                header("location:register_petasub_category.php");
            }
            else                                                                                                                      
            {
                echo "not inserted !!1";
               // header("location:hotel_maincat_assign.php");
            }
        }
    }
?>