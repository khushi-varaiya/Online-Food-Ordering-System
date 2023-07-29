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
            $_SESSION['mobile_no'] = $row["mobile_no"];
           
            if($row ["type"] == "USER")
            {
               
                header("location:home.php");
               // echo "USER";
            }
            elseif($row ["type"] == "ADMIN")
            {
                header("location:index.php");
                //echo "ADMIN";
            }
            elseif($row["type"] == "HOTEL")
            {
                header("location:hotel.php");
                //echo "HOTEL";
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
            header("location:login.php");
            //echo "Inserted successfully";
            //header('location:.php');
        }
        else
        {
            echo "Not Inserted";
        }
    }
}
if (isset($_POST['resetpassword'])) {
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $update_user = "UPDATE user SET `password` = '$cpassword' WHERE `mobile_no` = '$mobileNumber'";
    $user_result = mysqli_query($conn, $update_user);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['success_message'] = 'PASSWORD UPDATED SUCCESSFULLY !!!';
        header("location: login.php");
    } else {
        $update_hotel = "UPDATE hotel SET `password` = '$cpassword' WHERE `mobile_no` = '$mobileNumber'";
        $hotel_result = mysqli_query($conn, $update_hotel);

        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['success_message'] = 'PASSWORD UPDATED SUCCESSFULLY !!!';
            header("location: login.php");
        } else {
            $_SESSION['warning_message'] = 'PASSWORD UPDATED SUCCESSFULLY !!!';
            header("location: login.php");
        }
    }
}
if(isset($_POST['hotel']))
{
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
    $hotel_des = "registered_hotel/".$hotelname.".".$img_ext;
    if($img_ext!='jpg' && $img_ext!='png' && $img_ext!='jpeg')
    {
        echo "INVALID EXTENSTION !!!!";
        exit();
    }
    $img_loc1 = $_FILES['hotelmap']['tmp_name'];
    $img_name1 = $_FILES['hotelmap']['name'];
    $img_ext1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $map_des = "registered_hotel/".$hotelname.".".$img_ext1;
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

        $resultp = mysqli_query($conn, "SELECT MAX(package_bill_id) as last_idp FROM package_bill");
        $rowp = mysqli_fetch_assoc($resultp);
        $last_idp = $rowp['last_idp'];
        $next_idp = $last_idp + 1;

        $resulth = mysqli_query($conn, "SELECT MAX(hotel_id) as last_id FROM hotel");
        $rowh = mysqli_fetch_assoc($resulth);
        $hotel_id = $rowh['last_id'];

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
            header('Location: hotel.php');
        }
        else
        {
            echo "HURRY !!!NO DATA INSERTED SUCCESSFULLY TO DATABASE";
        }
      }
      else                                                                                                                      
      {
        echo "Not Inserted";
      }
    }

}

}
