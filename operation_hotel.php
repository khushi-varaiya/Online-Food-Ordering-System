<?php
include('conn.php');

session_start();
$query_id = "SELECT * FROM hotel WHERE hotel_name = '" . $_SESSION['username'] . "'";
$result_id = mysqli_query($conn, $query_id);
$row = mysqli_fetch_array($result_id);
if($row != NULL)
{
    $_SESSION['hotel_id'] = $row["hotel_id"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if(isset($_POST['main_cat_assign']))
    {
        //$hotel_id = $_SESSION['username'];
        $main_cat_assign = $_POST['main_cat'];
        $hotel_id = $_SESSION['hotel_id'];
        // echo $main_cat_assign;
        // echo $hotel_id;
        //$insert_maincat = "INSERT INTO `main_category_assign`(`main_cat_assign_id`, `hotel_id`, `main_cat_id`) VALUES ('[value-1]','[value-2]','[value-3]')";
        $check_query = "SELECT * FROM main_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND main_cat_id = '$main_cat_assign'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED !!!';
            header('Location: hotel_maincat_assign.php');
        }
        else
        {
            $resulth = mysqli_query($conn, "SELECT MAX(main_cat_assign_id) as last_id FROM main_category_assign");
            $rowh = mysqli_fetch_assoc($resulth);
            $last_id = $rowh['last_id'];
            
            $next_id = $last_id + 1;
            
            $insert_main = "INSERT INTO `main_category_assign`(`main_cat_assign_id`, `hotel_id`, `main_cat_id`) VALUES ('$next_id','$hotel_id','$main_cat_assign')";
            $insert_result = mysqli_query($conn, $insert_main);       
            if($insert_result)
            {
                $last_hotel_id = mysqli_insert_id($conn);
                $next_id = $last_hotel_id + 1;
                // after successful insertion of record
                $_SESSION['success_message'] = 'RECORD INSERTED SUCCESSFULLY !!!';
                header('Location: hotel_maincat_assign.php');
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT INSERTED !!!';
                header('Location: hotel_maincat_assign.php');
            }
        }
    }

    if(isset($_POST['sub_cat_assign']))
    {
        //$hotel_id = $_SESSION['username'];
        $sub_cat_assign = $_POST['sub_cat'];
        $hotel_id = $_SESSION['hotel_id'];
        
        $check_query = "SELECT * FROM sub_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND sub_cat_id = '$sub_cat_assign'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED !!!';
            header('Location: hotel_subcat_assign.php');
        }
        else
        {
            $resulth = mysqli_query($conn, "SELECT MAX(sub_cat_assign_id) as last_id FROM sub_category_assign");
            $rowh = mysqli_fetch_assoc($resulth);
            $last_id = $rowh['last_id'];
            
            $next_id = $last_id + 1;
            
            $insert_main = "INSERT INTO `sub_category_assign`(`sub_cat_assign_id`, `hotel_id`, `sub_cat_id`) VALUES ('$next_id','$hotel_id','$sub_cat_assign')";
            $insert_result = mysqli_query($conn, $insert_main);       
            if($insert_result)
            {
                $last_hotel_id = mysqli_insert_id($conn);
                $next_id = $last_hotel_id + 1;
                $_SESSION['success_message'] = 'RECORD INSERTED SUCCESSFULLY !!!';
                header("location:hotel_subcat_assign.php");
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT INSERTED !!!';
                header("location:hotel_subcat_assign.php");
            }

        }
    }

    if(isset($_POST['petasub_cat_assign']))
    {
        
        $petasub_cat_assign = $_POST['petasub_cat'];
        $hotel_id = $_SESSION['hotel_id'];
        
        $check_query = "SELECT * FROM petasub_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND petasub_cat_id = '$petasub_cat_assign'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED!!!';
            header('Location: hotel_petasub_assign.php');
        }
        else
        {
            $resulth = mysqli_query($conn, "SELECT MAX(petasub_cat_assign_id) as last_id FROM petasub_category_assign");
            $rowh = mysqli_fetch_assoc($resulth);
            $last_id = $rowh['last_id'];
            
            $next_id = $last_id + 1;
            
            $insert_main = "INSERT INTO `petasub_category_assign`(`petasub_cat_assign_id`, `hotel_id`, `petasub_cat_id`) VALUES ('$next_id','$hotel_id','$petasub_cat_assign')";
            $insert_result = mysqli_query($conn, $insert_main);       
            if($insert_result)
            {
                $last_hotel_id = mysqli_insert_id($conn);
                $next_id = $last_hotel_id + 1;
                $_SESSION['success_message'] = 'RECORD INSERTED SUCCESSFULLY !!!';
                header("location:hotel_petasub_assign.php");
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT INSERTED !!!';
                header("location:hotel_petasub_assign.php");
            }
        }
    }

    if(isset($_POST['item']))
    {
        
        $hotel_id = $_SESSION['hotel_id'];
        $itemname = $_POST['itemname'];
        $hotel_id = $_SESSION['hotel_id'];
        $petasub_cat = $_POST['petasub_cat'];
        $price = $_POST['price'];
        $about = $_POST['about'];

        $img_loc = $_FILES['itemimage']['tmp_name'];
        $img_name = $_FILES['itemimage']['name'];
        $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $item_des = "registered_item/".$itemname.".".$img_ext;
        
        $check_query = "SELECT * FROM item WHERE hotel_id = '".$_SESSION['hotel_id']."' AND item_name = '$itemname'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'ITEM IS ALREADY ADDED !!!';
            header('Location: hotel_item.php');
        }
        else
        {
            $resulth = mysqli_query($conn, "SELECT MAX(item_id) as last_id FROM item");
            $rowh = mysqli_fetch_assoc($resulth);
            $last_id = $rowh['last_id'];
            
            $next_id = $last_id + 1;
            
            $insert_main = "INSERT INTO `item`(`item_id`, `item_name`, `hotel_id`, `petasub_cat_id`, `image`, `price`, `about`) VALUES ('$next_id','$itemname','$hotel_id','$petasub_cat','$item_des','$price','$about')";
            $insert_result = mysqli_query($conn, $insert_main);       
            if($insert_result)
            {
                $last_hotel_id = mysqli_insert_id($conn);
                $next_id = $last_hotel_id + 1;
                move_uploaded_file($img_loc, $item_des);
                $_SESSION['success_message'] = 'ITEM INSERTED SUCCESSFULLY !!!';
                header("location:hotel_item.php");
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'ITEM NOT INSERTED !!!';
                header("location:hotel_item.php");
            }
        }
    }
    if(isset($_POST['main_cat_update']))
    {
        $selected_main_cat = $_POST['main_cat_u'];
        $main_cat_assign_id = $_POST['main_cat_assign_id'];
        // echo $selected_main_cat;
        // echo $main_cat_assign_id;
        $check_query = "SELECT * FROM main_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND main_cat_id = '$selected_main_cat'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED !!!';
            header('Location: hotel_maincat_assign.php');
        }
        else
        {
            $update_main = "UPDATE `main_category_assign` SET  `main_cat_id`='$selected_main_cat' WHERE `main_cat_assign_id`='$main_cat_assign_id'";
            $update_result = mysqli_query($conn, $update_main);       
            if($update_result)
            {
                $_SESSION['success_message'] = 'RECORD UPDATED SUCCESSFULLY !!!';
                header('Location: hotel_maincat_assign.php');
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT UPDATED !!!';
                header('Location: hotel_maincat_assign.php');
            }
        }
    }

    if(isset($_POST['main_cat_delete']))
    {
        $main_cat_assign_id = $_POST['main_cat_assign_id'];
        $delete_main = "DELETE FROM `main_category_assign` WHERE `main_cat_assign_id`='$main_cat_assign_id'";
        $delete_result = mysqli_query($conn, $delete_main);       
        if($delete_result)
        {
            // $delete_subcat = "DELETE FROM ";
            $_SESSION['success_message'] = 'RECORD DELETE SUCCESSFULLY !!!';
            header('Location: hotel_maincat_assign.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'RECORD NOT DELETED !!!';
            header('Location: hotel_maincat_assign.php');
        }
    }

    if(isset($_POST['sub_cat_update']))
    {
        $selected_sub_cat = $_POST['sub_cat_u'];
        $sub_cat_assign_id = $_POST['sub_cat_assign_id'];
        $check_query = "SELECT * FROM sub_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND sub_cat_id = '$selected_sub_cat'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED !!!';
            header('Location: hotel_subcat_assign.php');
        }
        else
        {
            $update_sub = "UPDATE `sub_category_assign` SET  `sub_cat_id`='$selected_sub_cat' WHERE `sub_cat_assign_id`='$sub_cat_assign_id'";
            $update_result = mysqli_query($conn, $update_sub);       
            if($update_result)
            {
                $_SESSION['success_message'] = 'RECORD UPDATED SUCCESSFULLY !!!';
                header('Location: hotel_subcat_assign.php');
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT UPDATED !!!';
                header('Location: hotel_subcat_assign.php');
            }
        }
    }

    if(isset($_POST['sub_cat_delete']))
    {
        $sub_cat_assign_id = $_POST['sub_cat_assign_id'];
        $delete_sub = "DELETE FROM `sub_category_assign` WHERE `sub_cat_assign_id`='$sub_cat_assign_id'";
        $delete_result = mysqli_query($conn, $delete_sub);       
        if($delete_result)
        {
            $_SESSION['success_message'] = 'RECORD DELETE SUCCESSFULLY !!!';
            header('Location: hotel_subcat_assign.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'RECORD NOT DELETED !!!';
            header('Location: hotel_subcat_assign.php');
        }
    }

    if(isset($_POST['petasub_cat_update']))
    {
        $selected_petasub_cat = $_POST['petasub_cat_u'];
        $petasub_cat_assign_id = $_POST['petasub_cat_assign_id'];
        $check_query = "SELECT * FROM petasub_category_assign WHERE hotel_id = '".$_SESSION['hotel_id']."' AND petasub_cat_id = '$selected_petasub_cat'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0)
        {
            $_SESSION['warning_message'] = 'CATEGORY IS ALREADY ASSIGNED !!!';
            header('Location: hotel_petasub_assign.php');
        }
        else
        {
            $update_petasub = "UPDATE `petasub_category_assign` SET  `petasub_cat_id`='$selected_petasub_cat' WHERE `petasub_cat_assign_id`='$petasub_cat_assign_id'";
            $update_result = mysqli_query($conn, $update_petasub);       
            if($update_result)
            {
                $_SESSION['success_message'] = 'RECORD UPDATED SUCCESSFULLY !!!';
                header('Location: hotel_petasub_assign.php');
            }
            else                                                                                                                      
            {
                $_SESSION['failed_message'] = 'RECORD NOT UPDATED !!!';
                header('Location: hotel_petasub_assign.php');
            }
        }
    }

    if(isset($_POST['petasub_cat_delete']))
    {
        $petasub_cat_assign_id = $_POST['petasub_cat_assign_id'];
        $delete_petasub = "DELETE FROM `petasub_category_assign` WHERE `petasub_cat_assign_id`='$petasub_cat_assign_id'";
        $delete_result = mysqli_query($conn, $delete_petasub);       
        if($delete_result)
        {
            $_SESSION['success_message'] = 'PETASUB CATEGORY DELETE SUCCESSFULLY !!!';
            header('Location: hotel_petasub_assign.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'PETASUB CATEGORY NOT DELETED !!!';
            header('Location: hotel_petasub_assign.php');
        }
    }

    if (isset($_POST['item_update'])) {
        $item_id = $_POST['item_id'];
        $item_name = $_POST['itemname'];
        $petasub_cat = $_POST['petasub_cat_u'];
        $price = $_POST['price'];
        $about = $_POST['about'];
    
        if (isset($_FILES['itemimage'])) {
            $img_tmp = $_FILES['itemimage']['tmp_name'];
            $img_name = $_FILES['itemimage']['name'];
            $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_path = "registered_item/".$item_name.".".$img_ext;
            // Move the uploaded file to the desired location
            // move_uploaded_file($img_tmp, $img_path);

            
                $item_update = "UPDATE `item` SET `item_name`='$item_name',`petasub_cat_id`='$petasub_cat',`image`='$img_path',`price`='$price',`about`='$about' WHERE `item_id`='$item_id'";
                $item_result = mysqli_query($conn,$item_update);
                if($item_result)
                {
                    move_uploaded_file($img_tmp, $img_path);
                    $_SESSION['success_message'] = 'ITEM UPDATED SUCCESSFULLY !!!';
                    header("location:hotel_item.php");
                }
                else
                {
                    $_SESSION['failed_message'] = 'ITEM NOT UPDATED !!!';
                    header("location:hotel_item.php");
                }
        }
    }
    
    if(isset($_POST['item_delete']))
    {
        $item_id = $_POST['item_id'];
        $delete_item = "DELETE FROM `item` WHERE `item_id` = '$item_id'";
        $delete_result = mysqli_query($conn,$delete_item);
        if($delete_result)
        {
            $_SESSION['success_message'] = 'ITEM DELETED SUCCESSFULLY !!!';
            header('Location: hotel_item.php');
        }
        else
        {
            $_SESSION['failed_message'] = 'ITEM NOT DELETED SUCCESSFULLY !!!';
            header('Location: hotel_item.php');
        }
    }

    if(isset($_POST['update_hotel']))
    {
        //echo "PROFILE";
        $hotel_id = $_POST['update_hotel_id'];
        $hotelName = $_POST['hotel_name'];
        // $mobileNo = $_POST['mobile_no'];
        $area = $_POST['area'];
        $areaText = $_POST['area_text'];
        $landmark = $_POST['landmark'];
        $landmarkText = $_POST['landmark_text'];
        $packageName = $_POST['package_name'];
        $address = $_POST['address'];
        $openTime = $_POST['open_time'];
        $openTimeText = $_POST['opentime_text'];
        $openDays = $_POST['open_days'];
        $openDaysText = $_POST['opendays_text'];
        $password = $_POST['password'];

        $update_hotel = "UPDATE `hotel` SET `area_id`='$area',`landmark_id`='$landmark',`address`='$address',`open_time`='$openTime',`open_days`='$openDays',`password`='$password' WHERE `hotel_id`='$hotel_id'";
        $update_result = mysqli_query($conn, $update_hotel);       
        if($update_result)
        {
            $_SESSION['success_message'] = 'RECORD UPDATED SUCCESSFULLY !!!';
            header('Location: hotel_profile.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'RECORD NOT UPDATED !!!';
            header('Location: hotel_profile.php');
        }
    }

    if(isset($_FILES['hotel_image']))
    {
        // echo"IMAGE";
       $hotel_id = $_POST['update_hotel_id'];
       $hotelName = $_POST['hotel_name'];
        
       $img_loc = $_FILES['hotel_image']['tmp_name'];
       $img_name = $_FILES['hotel_image']['name'];
       $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
       $hotel_des = "registered_hotel/".$hotelName;

       $update_hotel = "UPDATE `hotel` SET `image`='$hotel_des' WHERE `hotel_id`='$hotel_id'";
        $update_result = mysqli_query($conn, $update_hotel);       
        if($update_result)
        {
            move_uploaded_file($img_loc, $hotel_des);
            $_SESSION['success_message'] = 'PROFILE UPDATED SUCCESSFULLY !!!';
            header('Location: hotel_profile.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'PROFILE NOT UPDATED !!!';
            header('Location: hotel_profile.php');
        }
    }

    if(isset($_FILES['hotel_map']))
    {
       $hotel_id = $_POST['update_hotel_id'];
       $hotelName = $_POST['hotel_name'];
        
       $img_loc = $_FILES['hotel_map']['tmp_name'];
       $img_name = $_FILES['hotel_map']['name'];
       $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
       $hotel_des = "registered_hotel/".$img_name.".".$img_ext;

       $update_hotel = "UPDATE `hotel` SET `map`='$hotel_des' WHERE `hotel_id`='$hotel_id'";
        $update_result = mysqli_query($conn, $update_hotel);       
        if($update_result)
        {
            move_uploaded_file($img_loc, $hotel_des);
            $_SESSION['success_message'] = 'LOCATION UPDATED SUCCESSFULLY !!!';
            header('Location: hotel_location.php');
        }
        else                                                                                                                      
        {
            $_SESSION['failed_message'] = 'LOCATION NOT UPDATED !!!';
            header('Location: hotel_location.php');
        }
    } 
    
    if(isset($_POST['order_id']))
    {
        //echo "HELLO";
        $order_cart_id = $_POST['order_cart_id'];
        $order_id = $_POST['order_id'];
        $status = "delivered";

        $update_order = "UPDATE `order_cart` SET `status` = '$status' WHERE `order_id` = '$order_id' AND `order_cart_id` = '$order_cart_id'";
        $update_result = mysqli_query($conn, $update_order);        
        if($update_result)
        {
            $_SESSION['success_message'] = 'ORDER ID ' . $order_id . ' IS DELIVERED SUCCESSFULLY !!!';
            header('Location: hotel_order.php');
        }
        else {
            $_SESSION['warning_message'] = 'STATUS OF'. $order_id .  'IS NOT CHANGED !!!';
            header('Location: hotel_order.php');
        }
    }

    if(isset($_POST['undo_order_id']))
    {
        // echo "HELLO";
        $order_cart_id = $_POST['undo_order_cart_id'];
        $order_id = $_POST['undo_order_id'];
        $status = "pending";

        $update_order = "UPDATE `order_cart` SET `status` = '$status' WHERE `order_id` = '$order_id' AND `order_cart_id` = '$order_cart_id'";
        $update_result = mysqli_query($conn, $update_order);        
        if($update_result)
        {
            $_SESSION['success_message'] = 'ORDER ID ' . $order_id . ' IS NOT DELIVERED!!!';
            header('Location: hotel_order.php');
        }
        else {
            $_SESSION['warning_message'] = 'STATUS OF'. $order_id .  'IS NOT CHANGED!!!';
            header('Location: hotel_order.php');
        }
    }

    if(isset($_POST['transaction']))
    {
        $package_bill_id = $_POST['transaction'];
        // echo $package_bill_id;
        $update_order = "UPDATE `package_bill` SET `bill_date` = CURDATE() WHERE `package_bill_id` = '$package_bill_id'";
        $update_result = mysqli_query($conn, $update_order);
        
        if(mysqli_affected_rows($conn) > 0)
        {
            $_SESSION['success_message'] = 'PAYMENT DONE SUCCESSFULLY !!!';
            header('Location: hotel_packagebill.php');
        }
        else {
            $_SESSION['warning_message'] = 'PAYMENT REQUEST FAILED';
            header('Location: hotel_packagebill.php');
        }
        
    }
    if(isset($_POST['update_package']))
    {
        //echo "HELLO";

        $package = $_POST['package'];
        $hotel_id = $_SESSION['hotel_id'];

        echo $package_update;
        echo $hotel_id;

        $resultp = mysqli_query($conn, "SELECT MAX(package_bill_id) as last_idp FROM package_bill");
        $rowp = mysqli_fetch_assoc($resultp);
        $last_idp = $rowp['last_idp'];
        $next_idp = $last_idp + 1;

        $resultr = mysqli_query($conn, "SELECT rate FROM package WHERE package_id = '$package'");
        $rowr = mysqli_fetch_assoc($resultr);
        $rate = $rowr['rate'];

        $duration = "SELECT SUBSTRING_INDEX(package.duration, 'MONTHS', 1) AS duration_in_months FROM package WHERE package_id = '$package'";
        $result = mysqli_query($conn, $duration);
        if ($result && mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            $durationInMonths = $row['duration_in_months'];

            $startDate = date('d-m-Y'); // Current date
            $endDate = date('d-m-Y', strtotime("+{$durationInMonths} months", strtotime($startDate)));
        } 
        else 
        {
            echo "No duration found";
        }

        $insert_package = "INSERT INTO `package_bill`(`package_bill_id`, `hotel_id`, `package_id`, `bill_date`, `start_date`, `end_date`, `rate`) VALUES ('$next_idp','$hotel_id','$package','','$startDate','$endDate','$rate')";
        $insert_package = mysqli_query($conn, $insert_package);
        if($insert_package)
        {
            //echo "HURRY !!! DATA INSERTED SUCCESSFULLY TO DATABASE";
            $_SESSION['username'] = $hotelname;
            $_SESSION['success_message'] = 'REGISTERED SUCCESSFULLY !!';
            header('Location: hotel_packageinfo.php');
        }
        else
        {
            echo "HURRY !!!NO DATA INSERTED SUCCESSFULLY TO DATABASE";
            header('Location: hotel_packageinfo.php');
        }
    }
}
?>
 