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
  // Replace 'print-invoice.php' with the actual URL of the page
  var url = 'print-invoice.php';
  
  // Add any necessary query parameters to the URL (if required)
  // For example: url += '?invoice_id=123';
  
  // Open the URL in a new window or tab
  window.open(url, '_blank');
}
</script>

<script>
  function validateForm(event) {
    var accountName = document.getElementById('account_name').value.trim();
    var accountNumber = document.getElementById('account_number').value.trim();
    var mobileNumber = document.getElementById('mobile_number').value.trim();
    var amount = document.getElementById('amount').value.trim();
    
    var accountNameError = document.getElementById('account_name_error');
    var accountNumberError = document.getElementById('account_number_error');
    var mobileNumberError = document.getElementById('mobile_number_error');
    var amountError = document.getElementById('amount_error');
    
    // Reset error messages
    accountNameError.textContent = '';
    accountNumberError.textContent = '';
    mobileNumberError.textContent = '';
    amountError.textContent = '';
    
    // Check if fields are empty and display error messages
    if (accountName === '') {
      accountNameError.textContent = '*';
      event.preventDefault(); // Prevent form submission
    } 
    else if (accountName.length <= 2) 
    {
      accountNameError.textContent = 'Account holder name should have more than 2 letters';
      event.preventDefault(); // Prevent form submission
    }

    if (accountNumber === '' && mobileNumber === '') {
  accountNumberError.textContent = '*';
  mobileNumberError.textContent = '*';
  event.preventDefault(); // Prevent form submission
} else if (accountNumber !== '' && !/^\d{11}$/.test(accountNumber)) {
  accountNumberError.textContent = 'ACC.NO should be of 11 digits !!';
  event.preventDefault(); // Prevent form submission
} else if (mobileNumber !== '' && !/^\d{10}$/.test(mobileNumber)) {
  mobileNumberError.textContent = '10 Digits !!';
  event.preventDefault(); // Prevent form submission
}

    if (amount === '') {
      amountError.textContent = '*';
      event.preventDefault(); // Prevent form submission
    }
  }
</script>
<script>
  function togglePaymentForm() {
    var paymentForm = document.getElementById("payment-form");
    paymentForm.style.display = (paymentForm.style.display === "none") ? "block" : "none";
  }
</script>
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
                <h3 class="card-title">PACKAGE BILL</h3>
               
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
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SR.NO</th>
                      <th>PACKAGE NAME</th>
                      <th>PAYMENT-DATE</th>
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
                  <img src="dist/img/credit/icici.png" alt="icici" height="50px" width="80px">
                  <img src="dist/img/credit/hdfc.png" alt="hdfc"  height="50px" width="80px">
                  <img src="dist/img/credit/paytm.png" alt="paytm" height="50px" width="80px">
                  <img src="dist/img/credit/googlepay.png" alt="google pay" height="50px" width="80px">
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
              <div class="row no-print">
                <div class="col-12">
                  <a href="print-invoice.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
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
    <form id="payment-form" style="display: none;" method="post" action="operation_hotel.php">
  <!-- Payment form fields -->
  <input type="text" name="account_name" id="account_name" placeholder="ACCOUNT HOLDER'S NAME" style="width:200px;">
  <span id="account_name_error" class="error"></span>
  
  <input type="text" name="account_number" id="account_number" placeholder="ACCOUNT NUMBER">
  <span id="account_number_error" class="error"></span>
  
  <input type="text" name="mobile_number" id="mobile_number" placeholder="MOBILE NO">
  <span id="mobile_number_error" class="error"></span>
  
  <input type="text" name="amount" id="amount" placeholder="AMOUNT" value="<?php echo "RS. " . number_format($totalAmount, 2);?>" readonly>
  <span id="amount_error" class="error"></span>
  <input type="hidden" name="transaction" id="transaction" value="<?php echo $row['package_bill_id']; ?>">
  <button type="submit" class="btn btn-primary" onclick="validateForm(event)">Submit</button>
</form>

</div>
</div>
</div>
<?php
include('hotel_footer.php');
?>

