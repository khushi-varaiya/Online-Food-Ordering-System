<!DOCTYPE html>
<html lang="en">

<head>
    <title>TASTY TRACK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <style>
        .red-heart {
            color: red;
        }
    </style>
</head>
<body>
    <?php
    ?>
    <header class="header">
        <a class="logo" href="home.php"><img src="images/logo/logo1.png" style="height: 80px;"></a>
        <nav class="navbar">
            <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a href="search.php"><i class="fa fa-search" aria-hidden="true"></i> Search </a>
            <a href="item.php">Item</a>
            <a href="aboutus.php">About us</a>
            <a href="contactus.php">Contact us</a>
            <a href="<?php
                        $username = isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "";
                        include('db.php');
                        $sql  = "select * from add_to_cart where mobile_no = '$username'";
                        $qurry = mysqli_query($conn, $sql);
                        if (!mysqli_num_rows($qurry)) {
                            echo "addd_to_cart_page.php";
                        }
                        ?>"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="prof.php"><i class="fa-solid fa-user" name="profile"></i></a>
            <a href="login.php"><i class="fa-solid fa-sign-out"></i></a>
        </nav>
    </header>
</body>

</html>