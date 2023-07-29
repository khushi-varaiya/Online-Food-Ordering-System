<!DOCTYPE html>
<html>
<?php
include('header_profile.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TASTY TRACK</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/header_profile.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    include('db.php');

    $mno = isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : 0;

    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
    $sqlForM = "select  mobile_no from user where fname = '$username'";
    $queryForM = mysqli_query($conn, $sqlForM);



    while ($rowForM = mysqli_fetch_assoc($queryForM)) {
        $mobile_no = $rowForM['mobile_no'];
    }

    // $_SESSION['mn'] = $mobile_no;
    // echo $user;
    $sql = "select * from user where fname = '$username'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
    ?>



        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 container-fluid">
                        <!-- Profile Image -->
                        <div class="row">
                            <div class="col container-fluid">
                                <div class="card card-primary  container-fluis">
                                    <div class="card-body box-profile">
                                        <div class="text-center" style="height: 25%; ">
                                            <img style="height: 270px; width: auto; border: none;" class="profile-user-img img-fluid img-circle" src="Images/undraw_Female_avatar_efig.png" alt="User profile picture">
                                            <br>
                                            <h1 class="text-center " style="color: #fd7e14; "><?php echo $row["fname"]; ?></h1>
                                            <br>
                                            <br>
                                        </div>

                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    <div class="col-md-8">

                        <!-- Profile Image -->
                        <div class="row">
                            <div class="col">
                                <div class="card card-primary container-fluid mx-5">
                                    <div class="card-body box-profile">
                                        <div class="tab-pane" id="settings">
                                            <form class="form-horizontal" method="post" action="add_to_favorite.php" style="width: 80%;">

                                                <!-- <h2 class="text-center  my-5 "><?php echo $user ?></h2> -->
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Mobile No.</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName" name="mobile_no" placeholder="mobileno" value="<?php echo $row['mobile_no']; ?>">
                                                        <!-- <input type="hidden" class="form-control" id="inputName" name="mobile_no" placeholder="mobileno" value="<?php echo $mobile_no; ?>"> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">First Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail" placeholder="First Name" name="fname" value="<?php echo $row['fname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Last Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName2" placeholder="Last Name" name="lname" value="<?php echo $row['lname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Password" name="email" value="<?php echo $row['email']; ?>">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Password" name="password" value="<?php echo $row['password']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Gender</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Gender" name="gender" value="<?php echo $row['gender']; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-danger" name="btn_profile_update">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>

                            <!-- /.card -->

                        </div>
                    <?php
                }
                    ?>

                    </div>
                </div><br>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        </div>
        <div class="  container-fluid col-lg-8  ">
            <div class=" container-fluid">
                <div class="card container-fluid profile_box">
                    <div class="card-header p-2 container-fluid">
                        <ul class="nav nav-pills">
                            <!-- <li class="nav-item"><a class="nav-link " href="#profile" data-toggle="tab">Profile</a></li> -->
                            <li class="nav-item"><a class="nav-link active " href="#favorite" data-toggle="tab">Favorites</a></li>
                            <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">History</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body container-fluid">
                        <div class="tab-content  container-fluid ">
                            <div class="tab-pane" id="profile">
                            </div>
                            <!-- /.tab-pane -->
                            <div class="active tab-pane" id="favorite">
                                <!-- The timeline -->
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="bg-orange">
                                        <tr>
                                            <th>Item</th>
                                            <th>Hotel</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>About</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('db.php');
                                        $sql = "SELECT f.*, i.*, hotel_name FROM favorite f, hotel h, item i WHERE f.item_id = i.item_id AND h.hotel_id = i.hotel_id AND f.mobile_no = '{$_SESSION['mobile_no']}'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>

                                                <tr>
                                                    <td><?php echo $row['item_name'] ?></td>
                                                    <td><?php echo $row['hotel_name'] ?></td>
                                                    <td> <img src="<?php echo $row['image'] ?>" height="100px" width="100px" /></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['about'] ?></td>
                                                    <td>
                                                        <form action="add_to_favorite.php" method="post">
                                                            <input type="hidden" name="favorite_id" value="<?php echo $row['favorite_id'];  ?>">
                                                            <button type="submit" name="btn_removeFavorite" style="border: none;background-color: transparent;">
                                                                <i class="fa fa-heart" style="border: none; color: red; "></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="history">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="bg-orange">
                                        <tr>
                                            <th>ID</th>
                                            <th>Hotel </th>
                                            <th>Item </th>
                                            <th>Image</th>
                                            <th>Qty</th>
                                            <th>Rs</th>
                                            <th>Discount</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // session_start();
                                        include('db.php');
                                        // $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

                                        // echo $_SESSION['mn'];
                                        // echo "select hotel_name, o.*, i.* from order_cart o, hotel h, item i, user u where o.hotel_id = h.hotel_id and o.item_id = i.item_id and u.mobile_no = o.mobile_no and u.mobile_no ='$mobile_no' ";
                                       // echo $mno;
                                        $sql = "select hotel_name, o.*, i.* from order_cart o, hotel h, item i, user u where o.hotel_id = h.hotel_id and o.item_id = i.item_id and u.mobile_no = o.mobile_no and u.mobile_no ='$mno' ";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['order_cart_id'] ?></td>
                                                    <td><?php echo $row['hotel_name'] ?></td>
                                                    <td><?php echo $row['item_name'] ?></td>
                                                    <td> <img src="<?php echo $row['image'] ?>" height="100px" width="100px" /></td>
                                                    <td><?php echo $row['quantity'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['discount'] ?></td>
                                                    <td><?php echo $row['final_amount'] ?></td>
                                                    <td><?php echo $row['order_date'] ?></td>
                                                    <td>
                                                        <button onclick="printBill(<?php echo $row['order_cart_id']; ?>)" type="submit" style="background: none; border: none;">
                                                        <i class="fas fa-print" style="color: red;"></i>
                                                    </button>
                                                </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
        <script>
    function printBill(orderCartId) {
        window.location.href = 'bill.php?order_cart_id=' + orderCartId;
    }
</script>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
</body>

</html>