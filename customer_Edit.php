<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');

?>


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="customer.php" style="color: orange;">User</a></li>
                        <li class="breadcrumb-item active">Edit User </li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>

                        <a href="area.php" class="btn  float-right btn-sm bg-orange">BACK</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="code.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        if (isset($_GET['mno'])) {
                                            $mno = $_GET['mno'];
                                            // echo $aid . "      " . $aid;
                                            // $_SESSION['mid'] = $mid;
                                            $sql = "select * from user where mobile_no = '$mno' ";
                                            $result = mysqli_query($con, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                foreach ($result as $row) {
                                        ?>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="oldmno" value="<?php echo $mno; ?>" />

                                                        <label>Mobile No. </label>
                                                        <input type="text" class="form-control" name="mno" value="<?php echo $row['mobile_no']; ?>" />

                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" />

                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="lname" value="<?php echo $row['lname']; ?>" />

                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" />

                                                        <label>Password</label>
                                                        <input type="text" class="form-control" name="pass" value="<?php echo $row['password']; ?>" />

                                                        <label>Gender</label>
                                                        <input type="text" class="form-control" name="gender" value="<?php echo $row['gender']; ?>" />
                                                    </div>

                                        <?php
                                                }
                                            } else {
                                                echo "no record found";
                                            }
                                        }
                                        ?>


                                        <div class="modal-footer">

                                            <button type="submit" class="btn bg-success" class="form-control" name="btnUserUpdate">UPDATE</button>
                                        </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>

</div><?php
        include('includes/script.php');
        ?>
<?php
include('includes/footer.php');
?>