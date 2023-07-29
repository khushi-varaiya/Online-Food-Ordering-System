<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-orange">Sales Analysis of Year 2022-23'</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sales </li>
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
                        <h3 class="card-title">Hotel Sales Analysis</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4>Hotel :</h4>
                        <form action="" method="post">
                            <select name="hotel_name" id="" onchange="this.form.submit()" style="color: white; background-color: black;">>
                                <option value="">--select hotel--</option>
                                <?php
                                $selectedHotel = isset($_POST['hotel_name']) ? $_POST['hotel_name'] : '';
                                $sql = "SELECT * FROM hotel";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $hotelName = $row['hotel_name'];
                                    $selected = $selectedHotel == $hotelName ? 'selected' : '';
                                    echo "<option value=\"$hotelName\" $selected>$hotelName</option>";
                                }
                                ?>
                            </select>
                        </form>

                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $hotelname = $_POST['hotel_name'];
                            if (isset($_POST['hotel_name'])) {

                                $sql = "SELECT count(*) as count_status, status FROM order_cart where hotel_id in (select hotel_id from hotel where hotel_name = '$hotelname') group by status;";
                                $query = mysqli_query($con, $sql);

                                $pending_count = 0;
                                $delivered_count = 0;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    if ($row['status'] == "PENDING") 
                                    {
                                        $pending_count = $row['count_status'];
                                        // echo $row['status'] . "   "  . $row['count_status'];
                                    }

                                    if ($row['status'] == "delivered") {
                                        $delivered_count = $row['count_status'];
                                        // echo $row['status'] . "   "  . $row['count_status'];
                                    }
                        ?>
                            <?php
                                }
                            }
                            ?>
                        <?php
                            // $selectedHotel = isset($_POST['hotel_name']) ? $_POST['hotel_name'] : '';
                            $sql = "SELECT count(*) as count_status, status FROM order_cart where hotel_id in (select hotel_id from hotel where hotel_name = '$hotelname');";
                            $query = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                                $totalOrders = $row['count_status'];
                            }
                        }
                        ?>
                        <div class="container-fluid">
                            <br>
                            <h5 class="text-center"> <?php echo (isset($totalOrders)) ? "Total Orders :" . $totalOrders : "";  ?></h5>
                        </div>
                    </div>
                    <br><BR><BR>
                    <div>


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


<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Pending Orders',
            'delivered Orders',

        ],
        datasets: [{
            // data: [5, 10],
            data: [<?php echo $pending_count ?>, <?php echo $delivered_count ?>],
            backgroundColor: ['red', '#378919'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
</script>

<?php
include('includes/footer.php');
?>