<!DOCTYPE html>
<html>
<?php
include('../user/header.php');

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TASTY TRACK</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="Assets/plugins/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" href="../user/css//style.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="Assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>

<body>
    <?php
    // session_start();
    include('DataBaseConfig/DataConnection.php');

    $user = $_SESSION['username'];
    $sql = "select * from user where fname = '$user'";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <div class="  container-fluid col-lg-8 my-5">
            <div class=" container-fluid">
                <div class="card container-fluid profile_box">
                    <div class="card-header p-2 container-fluid">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link " href="#favorite" data-toggle="tab">Favorites</a></li>
                            <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">History</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body container-fluid">
                        <div class="tab-content  container-fluid ">
                            <div class=" tab-pane active" id="profile">
                                <form class="form-horizontal" method="post" action="code.php">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Mobile No.</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="mno" placeholder="mobileno" value="<?php echo $row['mobile_no']; ?>">
                                            <input type="hidden" class="form-control" id="inputName" name="mobile_no" placeholder="mobileno" value="<?php echo $user; ?>">
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
                            <?php
                        }
                            ?>
                            </div>
                            <!-- /.tab-pane -->
                            <div class=" tab-pane" id="favorite">
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
                                        include('DataBaseConfig/DataConnection.php');
                                        $sql = "select f.*, i.* , hotel_name from favorite f, hotel h ,item i where f.item_id = i.item_id and h.hotel_id = i.hotel_id";
                                        $result = mysqli_query($con, $sql);
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
                                                        <form action="../user/add_to_favorite.php" method="post">

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


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        include('DataBaseConfig/DataConnection.php');
                                        $sql = "select h.*, o.*, i.* from order_cart o, hotel h, item i, user u where o.hotel_id = h.hotel_id and o.item_id = i.item_id and u.mobile_no = o.mobile_no and u.fname ='$user' ";
                                        $result = mysqli_query($con, $sql);
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



        <!-- jQuery -->
        <script src="Assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="Assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="Assets/dist/js/demo.js"></script>
</body>

</html>