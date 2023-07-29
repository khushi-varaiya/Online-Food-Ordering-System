<?php
session_start();
include('conn.php');
$query_id = "SELECT * FROM hotel WHERE hotel_name = '" . $_SESSION['username'] . "'";
$result_id = mysqli_query($conn, $query_id);
$row = mysqli_fetch_array($result_id);
if($row != NULL)
{
    $_SESSION['hotel_id'] = $row["hotel_id"];
}

if (isset($_SESSION['username'])) 
{

  $check_bill_date_query = "SELECT bill_date FROM package_bill WHERE hotel_id = '".$_SESSION['hotel_id']."'";
  $result = mysqli_query($conn, $check_bill_date_query);

  if ($result && mysqli_num_rows($result) > 0) 
  {
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $bill_date = $row['bill_date'];
        if ($bill_date == "") 
        {
          $_SESSION['success_message'] = 'Please submit the payment for your pending bill at your earliest convenience. Thank you for your cooperation. !!!';
        } 
    }
  }
}
?>
<?php
include('hotel_header.php');
include('hotel_navbar.php');
include('hotel_sidebar.php');
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 15000
      });
      <?php if(isset($_SESSION['success_message'])): ?>
        Toast.fire({
          icon: 'success',
          title: '<?php echo $_SESSION['success_message']; ?>'
        });
        <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['warning_message'])): ?>
        Toast.fire({
          icon: 'warning',
          title: '<?php echo $_SESSION['warning_message']; ?>'
        });
        <?php unset($_SESSION['warning_message']); ?>
      <?php endif; ?>
      <?php if(isset($_SESSION['failed_message'])): ?>
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
            <h1 class="m-0 text-dark">HOTEL DASHBOARD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="hotel.php">HOME</a></li>
              <li class="breadcrumb-item"><a href="login.php">LOGOUT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo $_SESSION['username'];?></h3>

                <p>PROFILE</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="hotel_profile.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <?php
                include('conn.php');
                $query = "select package_name from package where package_id in (SELECT package_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                $res = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($result);
                $row = mysqli_fetch_array($res);
                if($rows == 1)
                {
                  $packageid = $row['package_name'];
                }
                ?>
                <h3><?php echo $packageid; ?></h3>

                <p>PACKAGE INFORMATION</p>
              </div>
              <div class="icon">
                <i class="ion ion-star"></i>
              </div>
              <a href="hotel_packageinfo.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <?php
          $main_cat_count = 0;
                include('conn.php');
                $query = "SELECT Count(main_cat_assign_id) as main_cat_count from main_category_assign where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $main_cat_count = $row['main_cat_count'];
                }
                ?>
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo $main_cat_count; ?></h3>
                
                <p>MAIN CATEGORY</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="hotel_maincat_assign.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
          <?php
          $sub_cat_count = 0;
                include('conn.php');
                $query = "SELECT Count(sub_cat_assign_id) as sub_cat_count from sub_category_assign where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $sub_cat_count = $row['sub_cat_count'];
                }
                ?>
                <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3><?php echo $sub_cat_count ; ?></h3>

                <p>SUB - CATEGORY</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="hotel_subcat_assign.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
          <?php
          $petasub_cat_count = 0;
                include('conn.php');
                $query = "SELECT Count(petasub_cat_assign_id) as petasub_cat_count from petasub_category_assign where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $petasub_cat_count = $row['petasub_cat_count'];
                }
                ?>
            <div class="small-box bg-light">
              <div class="inner">
                <h3><?php echo $petasub_cat_count; ?></h3>

                <p>PETASUB - CATEGORY</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="hotel_petasub_assign.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
          <?php
          $item_count = 0;
                include('conn.php');
                $query = "SELECT Count(item_id) as item_count from item where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $item_count = $row['item_count'];
                }
                ?>
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo $item_count; ?></h3>

                <p>ITEMS</p>
              </div>
              <div class="icon">
                <i class="ion ion-spoon"></i>
              </div>
              <a href="hotel_item.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
             
            <div class="small-box bg-light">
              <div class="inner">
                <h3><?php echo "_" ?></h3>
                
                <p>LOCATION</p>
              </div>
              <div class="icon">
                <i class="ion ion-location"></i>
              </div>
              <a href="hotel_location.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
                <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>_</h3>

                <p>PACKAGE BILL</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice"></i>
              </div>
              <a href="hotel_packagebill.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
          <?php
          $order = 0;
                include('conn.php');
                $query = "SELECT Count(order_cart_id) as order_count from order_cart where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $order = $row['order_count'];
                }
                ?>
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo $order; ?></h3>

                <p>ORDER</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="hotel_order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    </section>
</div>
<?php
include('hotel_footer.php');
?>
