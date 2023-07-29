<?php
include('db.php');
session_start();
if (isset($_POST['minusbtn'])) {

  $addtocartid = $_GET['id'];

  $sqlFetchCart = "SELECT * FROM `add_to_cart` WHERE add_to_cart_id=$addtocartid";

  $queryFetchCart = mysqli_query($conn, $sqlFetchCart);

  $qty = 0;


  while ($rowFetchCart = mysqli_fetch_assoc($queryFetchCart)) {
    $qty = $rowFetchCart['qty'];
  }


  if ($qty > 1) {
    $qty = $qty - 1;
    $sql = "update add_to_cart set qty='$qty' where add_to_cart_id = $addtocartid";
    $query = mysqli_query($conn, $sql);
    if ($query) {
      // echo ">1";
      header("location:addd_to_cart_page.php");
    }
  } else {
    $sql = "delete from add_to_cart where add_to_cart_id = $addtocartid  ";
    $queryDeleteCart = mysqli_query($conn, $sql);
    if ($queryDeleteCart) {
      // echo "<1";
      header("location:addd_to_cart_page.php");
    }
  }
}

if (isset($_POST['plussbtn'])) {

  $addtocartid = $_GET['id'];

  $sqlFetchCart = "SELECT * FROM `add_to_cart` WHERE add_to_cart_id=$addtocartid";

  $queryFetchCart = mysqli_query($conn, $sqlFetchCart);

  $qty = 0;


  while ($rowFetchCart = mysqli_fetch_assoc($queryFetchCart)) {
    $qty = $rowFetchCart['qty'];
  }



  $qty = $qty + 1;
  $sql = "update add_to_cart set qty='$qty' where add_to_cart_id = $addtocartid";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    // echo ">1";
    header("location:addd_to_cart_page.php");
  }
}




if (isset($_POST['discount_btn'])) {
  $discount_name = $_POST['discount_name'];

  $sql = "SELECT * FROM discount WHERE discount_name = '$discount_name'";
  $query = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($query)) {
    $percent = $row['percentage'];

  }
  $_SESSION['percentage'] = $percent;
  $_SESSION['discount_name'] = $discount_name;
  header("location:addd_to_cart_page.php");
} else {
}

if (isset($_POST['add_address'])) {
  $address = $_POST['address_name'];
  $_SESSION['address'] = $address;
  header("location:addd_to_cart_page.php");
}
