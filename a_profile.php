<?php

session_start();

// echo "--------------------------". $_SESSION['username'];
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');

$fname = $lname = $mno = $email = $password = $gender = "";

$mobile_no =  $_SESSION['mobile_no'];

//update
if (isset($_POST['btn_profile_update'])) {



    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mno = $_POST['mno'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $update_sql = "UPDATE `user` SET `mobile_no`='$mno',`fname`='$fname',`lname`='$lname',`email`='$email',`password`='$password',`gender`='$gender' WHERE mobile_no = '$mobile_no'";
    $query = mysqli_query($con, $update_sql);
    if ($query > 0) {
        $_SESSION['status'] = "Successfully Updated.";
    } else {
        $_SESSION['status'] = "Not Updated.";
    }
}



$sql = "select * from user where mobile_no='$mobile_no'";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($query)) {
?>

    <head>
        <link rel="stylesheet" href="Assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="Assets/plugins/toastr/toastr.min.css">
        <script src="Assets/plugins/jquery/jquery.min.js"></script>
        <script src="Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="Assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="Assets/plugins/toastr/toastr.min.js"></script>

        <script type="text/javascript">
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                <?php if (isset($_SESSION['status'])) : ?>
                    Toast.fire({
                        icon: 'success',
                        title: '<?php echo $_SESSION['status']; ?>'
                    });
                    <?php unset($_SESSION['status']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['status'])) : ?>
                    Toast.fire({
                        icon: 'warning',
                        title: '<?php echo $_SESSION['warning_message']; ?>'
                    });
                    <?php unset($_SESSION['warning_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['failed_message'])) : ?>
                    Toast.fire({
                        icon: 'danger',
                        title: '<?php echo $_SESSION['failed_message']; ?>'
                    });
                    <?php unset($_SESSION['failed_message']); ?>
                <?php endif; ?>
            });
        </script>
    </head>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Update Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                            <li class="breadcrumb-item"><a href="profile.php" style="color: orange;">Profile</a></li>
                            <!-- <li class="breadcrumb-item active">Main Category Details </li> -->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="row">
                            <div class="col">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center" style="height:378px; ">
                                            <img style="height: 30  0px; width: auto; border: none;" class="profile-user-img img-fluid img-circle" src="images/undraw_Female_avatar_efig.png" alt="User profile picture">
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
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="tab-pane" id="settings">
                                            <form class="form-horizontal" method="post">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Mobile No.</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName" name="mno" placeholder="mobileno" value="<?php echo $row["mobile_no"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">First Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail" placeholder="First Name" name="fname" value="<?php echo $row["fname"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Last Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName2" placeholder="Last Name" name="lname" value="<?php echo $row["lname"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Password" name="email" value="<?php echo $row["email"]; ?>">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Password" name="password" value="<?php echo $row["password"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills" class="col-sm-2 col-form-label">Gender</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills" placeholder="Gender" name="gender" value="<?php echo $row["gender"]; ?>">
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
                    </div>
                </div><br>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

<?php
}

?>
<?php
include('includes/script.php');
?>
<?php
include('includes/footer.php');
?>