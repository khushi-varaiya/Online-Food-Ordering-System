<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Button trigger modal -->


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item active">Orders </li>
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
                        <h3 class="card-title">Total Orders</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Order_ID</th>
                                    <th>Hotel</th>
                                    <th>Customer Name</th>
                                    <th>Mobile No.</th>
                                    <th>Items</th>
                                    <th>Qty.</th>
                                    <th>Discount</th>
                                    <th>Final Amt</th>
                                    <th>Bill Amount</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select o.*, h.*, i.*, u.* from order_cart o, hotel h, item i, user u where o.mobile_no = u.mobile_no and o.hotel_id = h.hotel_id and  o.item_id = i.item_id ";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {
                                ?>

                                        <tr>
                                            <td><?php echo $row['order_cart_id'] ?></td>
                                            <td><?php echo $row['hotel_name'] ?></td>
                                            <td><?php echo $row['fname'] ?></td>
                                            <td><?php echo $row['mobile_no'] ?></td>
                                            <td><?php echo $row['item_name'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td><?php echo $row['discount'] ?></td>
                                            <td><?php echo $row['final_amount'] ?></td>
                                            <td><?php echo $row['bill_amount'] ?></td>

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