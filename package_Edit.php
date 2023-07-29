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
                    <h1 class="m-0 text-dark">Package</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="package.php" style="color: orange;">Package</a></li>
                        <li class="breadcrumb-item"><a href="pack.php" style="color: orange;">Package Details</a></li>
                        <li class="breadcrumb-item active">Edit Package </li>

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
                        <h3 class="card-title">Edit Package</h3>

                        <a href="area.php" class="btn  float-right btn-sm bg-orange">BACK</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="code.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        if (isset($_GET['packid'])) {
                                            $pid = $_GET['packid'];
                                            // echo $aid . "      " . $aid;
                                            // $_SESSION['mid'] = $mid;
                                            $sql = "select * from package where package_id = '$pid' ";
                                            $result = mysqli_query($con, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                foreach ($result as $row) {
                                        ?>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="packid" value="<?php echo $pid; ?>" />

                                                        <label>Package Name </label>
                                                        <input type="text" class="form-control" name="packname" value="<?php echo $row['package_name']; ?>" />

                                                        <label>Duration </label>
                                                        <input type="text" class="form-control" name="duration" value="<?php echo $row['duration']; ?>" />

                                                        <label>Rate </label>
                                                        <input type="text" class="form-control" name="rate" value="<?php echo $row['rate']; ?>" />
                                                    </div>

                                        <?php
                                                }
                                            } else {
                                                echo "no record found";
                                            }
                                        }
                                        ?>


                                        <div class="modal-footer">

                                            <button type="submit" class="btn bg-success" class="form-control" name="btnPackageUpdate">UPDATE</button>
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