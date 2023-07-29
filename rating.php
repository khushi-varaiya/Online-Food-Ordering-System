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
                    <h1 class="m-0 text-dark">Rating Of Hotel</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="rating.php" style="color: orange;">Rating Of Hotel</a></li>
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
                        <h3 class="card-title">All Rating Of Hotel Details</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Rate ID</th>
                                    <th>Hotel Name</th>
                                    <th>Mobile No.</th>
                                    <th>Customer Name</th>
                                    <th>Rating</th>
                                    <th>FeedBack</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                               $sql = "SELECT r.*, h.*, u.* FROM rate_hotel r, hotel h, user u WHERE r.mobile_no = u.mobile_no AND h.hotel_id = r.hotel_id";
                               $result = mysqli_query($con, $sql);
                               
                               if ($result) {
                                   if (mysqli_num_rows($result) > 0) {
                                       while ($row = mysqli_fetch_array($result)) {
                                ?>

                                        <tr>
                                            <td><?php echo $row['rate_id'] ?></td>
                                            <td><?php echo $row['hotel_name'] ?></td>
                                            <td><?php echo $row['mobile_no'] ?></td>
                                            <td><?php echo $row['fname'] ?></td>
                                            <td><?php echo $row['rating'] ?></td>
                                            <td><?php echo $row['feedback'] ?></td>
                                        </tr>


                                <?php
                                    }
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