<?php
include('db.php');
session_start();
?>
<?php
include('bill_header.php');
$order_cart_id = $_GET['order_cart_id'];
// echo $order_cart_id;
?> 
<html>
<head>
<style>
  .error {
    color: red;
    font-size:20px;
  }
</style>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <script>
  function downloadPDF() {
    // Options for html2pdf.js
    const options = {
      filename: 'TASTY TRACK.pdf', // Specify the filename for the downloaded PDF
      jsPDF: { format: 'letter' }, // Specify the page format of the PDF (e.g., 'letter', 'a4', etc.)
    };

    // Select the current page's HTML element
    const element = document.documentElement;

    // Start the conversion to PDF
    html2pdf().set(options).from(element).save();
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

</head>

<div class="content-wrapper" style="width:100%;margin-left:0px;">
    <div class="card">
              <div class="card-header">
              <h3 class="card-title" style="text-align: center;">ORDER BILL</h3>
              </div>
              <div class="card-body">
              <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> TASTY TRACK, Inc.
                    <small class="float-right">Date: <?php echo date('d/m/Y'); ?></small>
                  </h4>
                </div>
              </div>

              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                </br>
                  <b>Order ID:</b><?php echo $order_cart_id?><br>
                </br>
                

                </div>
                <!-- /.col -->
              </div>
              

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>ORDER ID</th>
                      <th>HOTEL NAME</th>
                      <th>ITEM NAME</th>
                      <th>QUANTITY</th>
                      <th>PRICE</th>
                      <th>TOTAL PRICE</th>
                      <th>DISCOUNT</th>
                      <th>FINAL AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0; 
                    $query = "SELECT o.*, i.*, h.hotel_name, u.*, i.price AS item_price FROM item i, order_cart o, hotel h, user u WHERE order_cart_id = '$order_cart_id' AND o.item_id = i.item_id AND o.hotel_id = h.hotel_id AND o.mobile_no = u.mobile_no";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                      foreach($result as $row)
                      {
                        $subtotal = $row['final_amount'] - $row['discount'];
                        $total += $subtotal; // Add the subtotal to the total                    
                        ?>
                   <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['hotel_name']; ?></td>
                    <td><?php echo $row['item_name'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo $row['item_price'] ?></td>
                    <td><?php echo $row['final_amount'] ?></td>
                    <td><?php echo $row['discount'] ?></td>
                    <td><?php echo $row['final_amount'] - $row['discount'] ?></td>
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
                  <img src="dist/img/credit/icici.png" alt="icici" height="50px" width="80px">
                  <img src="dist/img/credit/hdfc.png" alt="hdfc"  height="50px" width="80px">
                  <img src="dist/img/credit/paytm.png" alt="paytm" height="50px" width="80px">
                  <img src="dist/img/credit/googlepay.png" alt="google pay" height="50px" width="80px">
                  <address>
                  </br>
                  <b>Contact no: </b><?php echo $row['mobile_no'];?><br>
                  
                  <b>Order Date: </b><?php echo $row['order_date'];?><br>
                  </br>
                    <strong>To</strong><br>
                    <strong ><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></strong><br>
                    <span style="font-size: 20px;"><?php echo $row['address']; ?></span>
                    
                  </address>
                </div>
                <div class="col-6">
                  <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>RS. <?php echo $total; ?></td>
                      </tr>
                      <?php
                      $rate = $total; // The rate value from the package_bill table
                      $taxPercentage = 2.5; // The tax percentage
                      $tax = ($rate * $taxPercentage) / 100;
                      $totalAmount = $rate + $tax;
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
              <div class="row no-print">
                <div class="col-12">
                <button onclick="window.print()" class="btn btn-primary">
  <i class="fas fa-print"></i> Print
</button>

                  <button type="button" class="btn btn-success float-right" onclick="togglePaymentForm()">
  <i class="far fa-credit-card"></i> Submit Payment
</button>
<button type="button" class="btn btn-danger float-right" style="margin-right: 5px;" onclick="downloadPDF()">
  <i class="fas fa-download"></i> Download PDF
</button>

                </div>
              </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
</div>
</div>


