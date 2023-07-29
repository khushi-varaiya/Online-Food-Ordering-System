<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Button trigger modal -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="AddHotelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Hotel</h1>
                    <button type="button" class="btn-dismiss bg-danger" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid ; border-radius: 2px;">x</button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">


                        <div class="form-group">
                            <label>Hotel Name </label>
                            <input type="text" class="form-control" name="mno" />

                            <label>Mobile No </label>
                            <input type="text" class="form-control" name="fname" />
                            <br />
                            <label>Area :</label><br>
                            <select name="areaname">
                                <!-- <?php
                                        $sql = "select * from area";
                                        $query = mysqli_query($con, $sql);
                                        $aid = "";
                                        while ($row = mysqli_fetch_assoc($query)) {

                                        ?>
                                    <option><?php echo $row['area_name']; ?></option>
                                <?php
                                        }
                                ?> -->
    <!-- </select> -->
    <!-- <input type="text" class="form-control" name="gender" /> -->
    <!-- <br /> -->
    <!-- <label>Landmark </label>
                            <select name="landmarkname">
                                <?php
                                $sql = "select * from landmark where area_id  ";
                                $query = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($query)) {

                                ?>


                                    <option><?php echo $row['landmark_name']; ?></option>

                                <?php
                                }
                                ?>
                            </select> -->
    <!-- <input type="text" class="form-control" name="lname" /> -->

    <!-- <label>Package</label>
                            <input type="text" class="form-control" name="email" />

                            <label>Image</label>
                            <input type="text" class="form-control" name="pass" />

                            <label>Address</label>
                            <input type="text" class="form-control" name="gender" />

                            <label>Map </label>
                            <input type="text" class="form-control" name="gender" />

                            <label>Open Time </label>
                            <input type="text" class="form-control" name="gender" />

                            <label>Open Days </label>
                            <input type="text" class="form-control" name="gender" />

                            <label>Password</label>
                            <input type="text" class="form-control" name="gender" />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn bg-success" class="form-control" name="btnAddUser" id="btnAddUser">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">HOTELS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item active">Hotels </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Registered Hotels</h3>
                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#AddHotelModal" class="btn  float-right btn-sm bg-orange">ADD HOTEL</a> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Hotel ID</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>LandMark</th>
                                    <th>Package</th>
                                    <th>Image</th>
                                    <th>Open Time</th>
                                    <th>Open Days</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select * from hotel  ";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {
                                ?>

                                        <tr>
                                            <td><?php echo $row['hotel_id'] ?></td>
                                            <td><?php echo $row['hotel_name'] ?></td>
                                            <td><?php echo $row['mobile_no'] ?></td>
                                            <td><?php echo $row['landmark_id'] ?></td>
                                            <td><?php echo $row['package_id'] ?></td>
                                            <!-- <td><?php echo $row['image'] ?></td> -->
                                            <td><img src="<?php echo $row['image']; ?>" alt="Image" width="100" height="100"></td>
                                            <td><?php echo $row['open_time'] ?></td>
                                            <td><?php echo $row['open_days'] ?></td>

                                        </tr>


                                <?php
                                    }
                                }

                                ?>



                            </tbody>

                        </table>
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