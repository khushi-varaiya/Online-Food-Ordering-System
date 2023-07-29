<?php
include('conn.php');
session_start();

?>
<?php
include('hotel_header.php');
include('hotel_navbar.php');
include('hotel_sidebar.php');
?> 

<html>
<head>
  <style>
.toggle-switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
  background-color:white; /* Red color */
  border-radius: 10px;
  overflow: hidden;
}

.toggle-switch input[type="checkbox"] {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle-slider {
  position: absolute;
  top: 0;
  left: 0;
  width: 20px;
  height: 20px;
  background-color: #ff0000; /* Red color */
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
}

.toggle-switch input[type="checkbox"]:checked + .toggle-slider {
  background-color: #00ff00; /* Green color */
  transform: translateX(20px);
}

.toggle-slider:before {
  content: "";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
}
</style>
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
        timer: 3000
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
              <li class="breadcrumb-item"><a href="#">LOGOUT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">ORDER INFORMATION</h3>
                <!-- <a href ="#" data-toggle="modal" data-target="#main_cat_modal" class="btn btn-primary btn-md float-right">UNDO</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ORDER ID</th>
      <th>ID</th>
      <th>MOBILE NO</th>
      <th>ITEM NAME</th>
      <th>QTY</th>
      <th>PRICE</th>
      <th>DISC</th>
      <th>AMOUNT</th>
      <th>DATE</th>
      <th>ADDRESS</th>
      <th>STATUS</th>
      <th>UNDO</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query ="SELECT oc.*, h.hotel_name, i.item_name FROM order_cart oc JOIN hotel h ON oc.hotel_id = h.hotel_id JOIN item i ON oc.item_id = i.item_id WHERE h.hotel_id IN (SELECT hotel_id FROM hotel WHERE hotel_name = '".$_SESSION['username']."')";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
      foreach($result as $row)
      {
        ?>
    <tr>
      <td><?php echo $row['order_id']; ?></td>
      <td><?php echo $row['order_cart_id']; ?></td>
      <td><?php echo $row['mobile_no']; ?></td>
      <td><?php echo $row['item_name']; ?></td>
      <td><?php echo $row['quantity'] ?></td>
      <td><?php echo $row['price'] ?></td>
      <td><?php echo $row['discount'] ?></td>
      <td><?php echo $row['final_amount'] ?></td>
      <td><?php echo $row['order_date']?></td>
      <td><?php echo $row['address']?></td>
      <td>
  <?php if ($row['status'] == 'delivered'): ?>
    <span class="status-delivered">Delivered</span>
  <?php else: ?>
    <form method="POST" action="operation_hotel.php">
      <label class="toggle-switch">
        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
        <input type="checkbox" name="order_cart_id" value="<?php echo $row['order_cart_id']; ?>" onchange="this.form.submit()">
        <span class="toggle-slider"></span>
      </label>
      <span class="status-pending">Pending</span>
    </form>
  <?php endif; ?>
</td>
<td>
  <form method="POST" action="operation_hotel.php">
    <input type="hidden" name="undo_order_id" value="<?php echo $row['order_id']; ?>">
    <input type="hidden" name="undo_order_cart_id" value="<?php echo $row['order_cart_id']; ?>">
    <button type="submit" class="undo-button" title="Undo" style="background-color:transparent; border-color:transparent;">
    <i class="fas fa-sync" style="color: green;"></i>
    </button>
  </form>
</td>
    </tr>
    <?php
    }
  }
  else
  {
    ?>
    <tr>
      <td colspan="6" style="text-align: center;">NO RECORD FOUND !!!</td>
    </tr>
    <?php
    }
    ?>
</table>         
</div>
</div>
</div>
<?php
include('hotel_footer.php');
?>

