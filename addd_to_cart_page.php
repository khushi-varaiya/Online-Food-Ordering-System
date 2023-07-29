<?php include('header_profile.php');
session_start();
ob_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TASTY TRACK</title>
</head>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/header_profile.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .tbl_td {
            padding: 10px;
            border-bottom: solid 1px orange;
            background-color: transparent;
        }

        th {
            background-color: none;
        }
    </style>
</head>

<body>
    <?php
    $mn =  (isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "");
    $sql = "select * from add_to_cart where mobile_no = '$mn' ";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
    ?>
        <h3 class="text-center">NO ITEMS IN CART </h3>
        <a href="item.php" class="btn btn-warning" style="text-decoration: none; color: white; width: 30%; margin-left:35%;">ADD ITEM</a>
        <img src="Images/CART.png" alt="" height=500px" width="300px" class="container-fluid">
    <?php
    } else {
    ?>
        <h2 class="text-center" style="color: black; ">All Your Cart Details</h2>
        <table class=" text-center my-2 " style="width: 80%;border: none; margin-left: 100px; font-size: 20px;background-color: normalizer_normalize; text-align: center;">
            <thead class="bg-warning">
                <th class="tbl_td">Item</th>
                <th class="tbl_td">Image</th>
                <th class="tbl_td">Remove</th>
                <th class="tbl_td">Qty.</th>
                <th class="tbl_td">Add</th>
                <th class="tbl_td">Price</th>
                <th class="tbl_td">Total Price</th>
            </thead>
            <tbody>
                <?php
                $sqlFetchCart = "SELECT a.*, i.* FROM `add_to_cart` a, `item` i WHERE a.mobile_no = '$mn' AND i.item_id = a.item_id";
                $queryFetchCart = mysqli_query($conn, $sqlFetchCart);
                while ($row = mysqli_fetch_assoc($queryFetchCart)) {
                ?>
                    <tr>
                        <td class="tbl_td"><?php echo $row['item_name'] ?></td>
                        <td class="tbl_td"> <img src="<?php echo $row['image'] ?>" height="100px" width="100px" /></td>
                        <form action="mycart.php?id='<?php echo $row['add_to_cart_id'] ?>'" method="post">
                            <td class="tbl_td"> <button id="myButton" name="minusbtn" style="color: red; border: transparent; background-color: transparent; font-size: 60px;font-weight: 500;    ">-</button>
                            </td>
                            <td class="tbl_td"><?php echo $row['qty'] ?></td>
                            <td class="tbl_td"> <button name="plussbtn" style="color: green; border: transparent; background-color: transparent; font-size: 40px; font-weight: 500;   ">+</button></td>
                        </form>
                        <td class="tbl_td"><?php echo $row['price']  ?></td>
                        <td class="tbl_td"><?php echo $row['price'] * $row['qty']; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <label class="text-right">TOTAL : </label>
                    </td>
                    <td>
                        <label>
                            <?php
                            $sqlFetchCart = "SELECT a.*, i.* FROM `add_to_cart` a, `item` i WHERE a.mobile_no = '$mn' AND i.item_id = a.item_id";
                            $t_amt = 0;
                            $queryFetchCart = mysqli_query($conn, $sqlFetchCart);
                            while ($row = mysqli_fetch_assoc($queryFetchCart)) {
                                $t_amt += $row['price'] * $row['qty'];
                            }
                            echo $t_amt;
                            ?>

                        </label>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="row container-fluid mx-5">
            <br>
            <table class="text-center" style="width: 80%;border: none;  font-size: 20px;background-color: normalizer_normalize; text-align: center;">
                <tr>
                    <td>
                        <form action="mycart.php" class="my-3" method="POST">
                            <br>
                            <label class="container-fluid">Add Coupan Code :
                                <input type="text" class="form  " name="discount_name" value="<?php echo $_SESSION['discount_name'] ?? ""; ?>" size="50">
                                <button class="btn btn-success mx-2" name="discount_btn" style="background-color: green;  border: none; font-size: 15px; font-weight: 500; width: 10%">Apply</button>
                            </label>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="mycart.php" class="my-3" method="POST">
                            <label class="container-fluid">Add Address here :
                                <input type="text" name="address_name" value="<?php echo $_SESSION['address'] ?? ""; ?>" size="50">
                                <button name="add_address" class="btn btn-success mx-2" style=" background-color: green; border: none; font-size: 15px;font-weight: 500; width: 10%">Apply</button>
                            </label>
                        </form>
                    </td>
                </tr>
            </table>
            <br />
            <br>
            <table class="my-3" style="width: 80%;border: none; margin-left: 30px; font-size: 20px;background-color: normalizer_normalize; text-align: center;">
                <br>
                <tr style="border-top: solid 2px orange;background-color: transparent;">
                    <td class="py-3"> <label class="mx-5">discount :
                            <?php
                            $p = isset($_SESSION['percentage']) ?  $_SESSION['percentage'] : 0;

                            echo $discount_amt = ($t_amt * $p) / 100   ?>
                        </label></td>
                    <td><label>Final Amount: <?php echo $final_amt  = ($t_amt - $discount_amt);  ?></label></td>
                    <td>
                        <?php
                        if (isset($_POST['proceed'])) {
                            $mn = (isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "");
                            $sqlFetchCart = "SELECT a.*, i.* FROM `add_to_cart` a JOIN `item` i ON i.item_id = a.item_id WHERE a.mobile_no = '$mn'";
                            $queryFetchCart = mysqli_query($conn, $sqlFetchCart);

                            // Assigning the same order_cart_id for all records
                            $res = mysqli_query($conn, "SELECT MAX(order_cart_id) as ocid FROM order_cart ");
                            $rowid = mysqli_fetch_array($res);
                            $lastid = $rowid['ocid'];
                            $ocid = $lastid + 1;

                            while ($row = mysqli_fetch_assoc($queryFetchCart)) {
                                $res = mysqli_query($conn, "SELECT MAX(order_id) as oid FROM order_cart ");
                                $rowid = mysqli_fetch_array($res);
                                $lastid = $rowid['oid'];

                                $oid = $lastid + 1;
                                $hotel_id = $row['hotel_id'];
                                $qty = $row['qty'];
                                $itemid = $row['item_id'];
                                $price = $row['price'];
                                $final_price = $price * $qty;
                                $mobileno = $row['mobile_no'];
                                $discount_pr = $_SESSION["percentage"];
                                $decrease_amt  = ($final_price * $discount_pr) / 100;
                                $bill_amt = $final_price - $decrease_amt;
                                $currentDate = date('Y-m-d');
                                $address = $_SESSION['address'];
                                $addtocartid = $row["add_to_cart_id"];

                                // echo "INSERT INTO `order_cart`(`order_id`, `order_cart_id`, `hotel_id`, `mobile_no`, `item_id`, `quantity`, `price`, `discount`, `final_amount`, `bill_amount`, `order_date`, `address`, `status`) VALUES ('$oid','$ocid','$hotel_id','$mobileno','$itemid','$qty','$price','$decrease_amt','$final_price','$bill_amt','$currentDate','$address')";
                                $sql = "INSERT INTO `order_cart`(`order_id`, `order_cart_id`, `hotel_id`, `mobile_no`, `item_id`, `quantity`, `price`, `discount`, `final_amount`, `bill_amount`, `order_date`, `address`) VALUES ('$oid','$ocid','$hotel_id','$mobileno','$itemid','$qty','$price','$decrease_amt','$final_price','$bill_amt','$currentDate','$address')";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    $sql = "DELETE FROM add_to_cart WHERE add_to_cart_id = $addtocartid";
                                    $queryDeleteCart = mysqli_query($conn, $sql);
                                }
                            }

                            $_SESSION['percentage'] = null;
                            $_SESSION['address'] = null;
                            $_SESSION['discount_name'] = null;
                            header("location: bill.php?order_cart_id=$ocid");

                            //header("location:addd_to_cart_page.php");
                            // header("Location: " . $_SERVER['HTTP_REFERER']);
                        }
                        ?>
                        <form action="" method="post">
                            <!-- <button class="btn btn-warning" name="checkout" style="border: none; font-size: 120x; font-weight: 500; width: 80%;" data-toggle="modal" data-target="#delete_maincat">Proceed To CheckOut</button> -->
                            <button style="border: none; font-size: 120x; font-weight: 500; width: 80%;"><a href="#" class="btn btn-warning rounded-pill py-2 btn-block" data-toggle="modal" data-target="#delete_maincat">Proceed to checkout</a></button>
                        </form>
                    </td>
                </tr>
            </table>
            <br>
        <?php
    }
        ?>
        </div>

        <div class="modal fade" id="delete_maincat" tabindex="-1" role="dialog" aria-labelledby="delete_maincatLabel" aria-hidden="true">

            <?php

            if ($_SESSION['address'] != null) { ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete_maincatLabel">ORDER CONFIRMATION</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="order_confirmation" value="">
                                <label>ARE YOU SURE YOU WANT TO PROCEED WITH ORDER ?</label>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <p>ORDER ONCE PLACED CANNOT BE CANCELLED !!!</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="proceed" class="btn btn-success">CHECKOUT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete_maincatLabel">ADDRESS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="order_confirmation" value="">
                                <label>!! PLEASE ADD OR APPLY ADDRESS FIRST !!</label>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }

            ob_end_flush(); ?>
        </div>
        </div>
</body>

</html>