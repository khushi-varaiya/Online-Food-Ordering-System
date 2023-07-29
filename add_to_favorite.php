<?php
include('db.php');
session_start();
$mn =  (isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "");

if (isset($_POST['btn_removeFavorite'])) {
    $fid = $_POST['favorite_id'];
    $sql = "Delete from favorite where favorite_id = $fid";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("location:prof.php#favorite");
    }
}

if (isset($_POST['favorite_btn'])) {
    $item_id = $_POST['item_id'];
    $username = $_SESSION['username'];
    $sql = "select  mobile_no from user where fname = '$username'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {

        $mobile_no = $row['mobile_no'];
    }


    $sql = "select * from favorite where mobile_no = '$mobile_no' and item_id = '$item_id' ";
    $query = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($query);

    if ($row > 0) {

        $sql = "delete from favorite where  mobile_no = '$mobile_no' and item_id = '$item_id'";
        $query = mysqli_query($conn, $sql);
        if ($query > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            // header("location:item.php");
        }
    } else {
        echo "ELESS";
        $sql = "INSERT INTO `favorite`( `mobile_no`, `item_id`) VALUES ('$mobile_no','$item_id')";
        $query = mysqli_query($conn, $sql);

        if ($query > 0) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            // header("location:item.php");
        }
    }
}




// user profile update

if (isset($_POST['btn_profile_update'])) {

    $mobile_no = $_POST['mobile_no'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $gender = $_POST['gender'];






    $sqlForU = "update user set  fname = '$fname' , lname = '$lname' , email='$email', password ='$pass' , gender = '$gender' where mobile_no='$mobile_no'";
    $queryForU = mysqli_query($conn, $sqlForU);
    // $row = mysqli_fetch_assoc($query);
    if ($queryForU > 0) {
        // echo "hello";
        header("location:prof.php");
    } else {
        echo "not updated";
    }
}

// =================================