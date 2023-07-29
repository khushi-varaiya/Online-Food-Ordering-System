<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Button trigger modal -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Packagebill</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="package.php" style="color: orange;">Package</a></li>
                        <li class="breadcrumb-item active">Packagebill </li>
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
                        <h3 class="card-title">All Packagebill Details</h3>
                        \
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Package Bill ID</th>
                                    <th>Package Name</th>
                                    <th>Hotel Name</th>
                                    <th>Mobile No.</th>
                                    <th>Bill Date</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select pb.*, h.*, p.* from hotel h, package_bill pb, package p where pb.hotel_id = h.hotel_id and pb.package_id = p.package_id ";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {
                                ?>

                                        <tr>
                                            <td><?php echo $row['package_bill_id'] ?></td>
                                            <td><?php echo $row['package_name'] ?></td>
                                            <td><?php echo $row['hotel_name'] ?></td>
                                            <td><?php echo $row['mobile_no'] ?></td>
                                            <td><?php echo $row['bill_date'] ?></td>
                                            <td><?php echo $row['start_date'] ?></td>
                                            <td><?php echo $row['end_date'] ?></td>
                                            <td><?php echo $row['rate'] ?></td>

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