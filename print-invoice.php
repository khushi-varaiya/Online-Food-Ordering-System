<?php
include('conn.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> TASTY TRACK, Inc.
          <small class="float-right">Date: <?php echo date('d/m/Y'); ?></small>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
          <th>SR.NO</th>
          <th>PACKAGE NAME</th>
          <th>BILL-DATE</th>
          <th>START-DATE</th>
          <th>END-DATE</th>
          <th>RATE</th>
          </tr>
          </thead>
                    <tbody>
                    <?php
                    $query ="SELECT pb.*, h.hotel_name, p.package_name FROM package_bill pb JOIN hotel h ON pb.hotel_id = h.hotel_id JOIN package p ON pb.package_id = p.package_id WHERE h.hotel_id IN (SELECT hotel_id FROM hotel WHERE hotel_name = '".$_SESSION['username']."')";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                      foreach($result as $row)
                      {
                        ?>
                    <tr>
                      <td><?php echo $row['package_bill_id']; ?></td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td><?php echo $row['bill_date'] ?></td>
                      <td><?php echo $row['start_date'] ?></td>
                      <td><?php echo $row['end_date'] ?></td>
                      <td><?php echo $row['rate'] ?>.00</td>
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
                    </tbody>
                  </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="dist/img/credit/visa.png" alt="Visa">
        <img src="dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="dist/img/credit/american-express.png" alt="American Express">
        <img src="dist/img/credit/paypal2.png" alt="Paypal">
      </div>
      <!-- /.col -->
      <div class="col-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->
        <div class="table-responsive">
        <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>RS. <?php echo $row['rate'] ?>.00</td>
                      </tr>
                      <?php
                      $rate = $row['rate']; // The rate value from the package_bill table
                      $taxPercentage = 2.5; // The tax percentage
                      $tax = ($rate * $taxPercentage) / 100;
                      $totalAmount = $rate + $tax;
                      // echo "Rate: $" . number_format($rate, 2) . "<br>";
                      // echo "Tax (" . $taxPercentage . "%): $" . number_format($tax, 2) . "<br>";
                      // echo "Total Amount: $" . number_format($totalAmount, 2);
                      ?>
                      <tr>
                        <th>Tax (2.5%)</th>
                        <td><?php  echo "RS. " . number_format($tax, 2);?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php echo "RS. " . number_format($totalAmount, 2);?></td>
                      </tr>
                    </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
