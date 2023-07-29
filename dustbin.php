<?php 
require ('conn.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if(isset($_POST['login']))
    {
        $mobile_no = $_REQUEST['mobilenol'];
        $password = $_REQUEST['passwordl'];
        $remember = isset($_POST['remember']) ? $_POST['remember'] : 0;

        // validate mobile number and password

         if($remember == 1) 
        {
        setcookie('mobile_no', $mobile_no, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), "/");
        }

        $query = "SELECT mobile_no, password, fname, type FROM user WHERE mobile_no = '".$mobile_no."' AND password = '".$password."' UNION SELECT mobile_no, password, hotel_name, type FROM hotel WHERE mobile_no = '".$mobile_no."' AND password = '".$password."'";
        $result = mysqli_query($conn, $query);
        $res = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_array($res);
        if($rows == 1)
        {
            $_SESSION['username'] = $row["fname"];
            $_SESSION['password'] = $password;
            // echo "<div><h3>correct Username/password.</h3><br/></div>";
            if($row ["type"] == "USER")
            {
                header("location:user.php");
                echo "USER";
            }
            elseif($row ["type"] == "ADMIN")
            {
                header("location:admin.php");
                echo "ADMIN";
            }
            elseif($row["type"] == "HOTEL")
            {
                header("location:hotel.php");
                echo "HOTEL";
            }
        }
        else 
        {
            header("location:login.php?error=Incorrect Username/password !!!");
        }
    }

if(isset($_POST['user'])) 
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mobile_no = $_POST['mobilenou'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $passwordu = $_POST['passwordu'];
    
    // Check if mobile number already exists in database
    $check_query = "SELECT * FROM `user` WHERE `mobile_no`='$mobile_no'";
    $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0)
    {
        echo "YOU ARE ALREADY REGISTERED !!!";
    }
    else
    {
        $insert_query = "INSERT INTO `user`(`mobile_no`, `fname`, `lname`, `email`, `password`, `gender`) VALUES ('$mobile_no','$firstname','$lastname','$email','$passwordu','$gender')";
        $insert_result = mysqli_query($conn, $insert_query);
        if($insert_result)
        {
            echo "Inserted successfully";
            //header('location:.php');
        }
        else
        {
            echo "Not Inserted";
        }
    }
}

if(isset($_POST['hotel']))
{
    // var_dump($_POST);
    // var_dump($_FILES);
    
    $hotelname = $_POST['hotelname'];
    $mobile_noh = $_POST['mobilenoh'];
    $passwordh = $_POST['confirmpasswordh'];
    $area = $_POST['area'];
    $landmark = $_POST['landmark'];
    $package = $_POST['package'];
    $address = $_POST['address'];
    $opentime = $_POST['opentime'];
    $opendays = $_POST['openDays'];


    $img_loc = $_FILES['hotelimage']['tmp_name'];
    $img_name = $_FILES['hotelimage']['name'];
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $hotel_des = "hotel_images/".$hotelname.".".$img_ext;
    if($img_ext!='jpg' && $img_ext!='png' && $img_ext!='jpeg')
    {
        echo "INVALID EXTENSTION !!!!";
        exit();
    }
    $img_loc1 = $_FILES['hotelmap']['tmp_name'];
    $img_name1 = $_FILES['hotelmap']['name'];
    $img_ext1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $map_des = "hotel_map/".$hotelname.".".$img_ext1;
    if($img_ext1!='jpg' && $img_ext1!='png' && $img_ext1!='jpeg')
    {
        echo "INVALID EXTENSION !!!!";
        exit();
    }

    $check_query = "SELECT * FROM `hotel` WHERE `mobile_no`='$mobile_noh'";
    $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0)
    {
       echo "YOU ARE ALREADY REGISTERED !!!";
    }
    else
    {
        $resulth = mysqli_query($conn, "SELECT MAX(hotel_id) as last_id FROM hotel");
        $rowh = mysqli_fetch_assoc($resulth);
        $last_id = $rowh['last_id'];

        $next_id = $last_id + 1;

       $insert_query = "INSERT INTO `hotel`(`hotel_id`,`hotel_name`, `mobile_no`, `area_id`, `landmark_id`, `package_id`, `image`, `address`, `map`, `open_time`, `open_days`,`password`) VALUES ('$next_id','$hotelname','$mobile_noh','$area','$landmark','$package','$hotel_des','$address','$map_des','$opentime','$opendays','$passwordh')";
       $insert_result = mysqli_query($conn, $insert_query);
       if($insert_result)
       {
        $last_hotel_id = mysqli_insert_id($conn);
        $next_id = $last_hotel_id + 1;
        move_uploaded_file($img_loc, $hotel_des);
        move_uploaded_file($img_loc1,$map_des);
        echo "Inserted successfully";
        //header('location:.php');
      }
      else                                                                                                                      
      {
        echo "Not Inserted";
      }
    }
}
}