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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <script type="text/javascript">
    function validateForm() {
    var package = document.forms["package_form"]["package"].value;
    var selectTag = document.forms["package_form"]["package"];
    var errorElem = document.getElementById("package-error");
    if (package == "") {
        errorElem.innerHTML = "Please select a package!!!";
        errorElem.style.display = "block";
        selectTag.style.border = "2px solid red";
        selectTag.focus();
        return false;
    } else {
        errorElem.innerHTML = "";
        errorElem.style.display = "none";
        selectTag.style.border = "";
        return true;
    }
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
<!-- Modal -->
<div class="modal fade" id="main_cat_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">PACKAGE INFORMATION</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $check_bill_date_query = "SELECT bill_date FROM package_bill WHERE hotel_id = '" . $_SESSION['hotel_id'] . "'";
            $result = mysqli_query($conn, $check_bill_date_query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $bill_date = $row['bill_date'];
                    if ($bill_date == "") {
                        $_SESSION['success_message'] = 'Please Submit your payment of previous package than only you are eligible for next package.THANK YOU !!!!';
                        ?>
                        <div class="modal-body">
                            <p><?php echo $_SESSION['success_message']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        <?php
                    }
                    else {
                      ?>
                      <form action="operation_hotel.php" method="post" onsubmit="return validateForm()" name="package_form">
                          <div id="package-error" style="display: none; color: red; text-align: center; margin-top: 10px; font-size: 20px;"></div>
                          <div class="modal-body">
                              <div class="form-group">
                                  <label>SELECT PACKAGE :- </label>
                                  <?php
                                  $sql = "SELECT * FROM package";
                                  $result = mysqli_query($conn, $sql);
                                  ?>
                                  <select name="package" class="form-control select2" style="width: 100%;">
                                      <option value="">-------------------SELECT PACKAGE-------------------</option>
                                      <?php
                                      while ($r = mysqli_fetch_array($result)) {
                                          ?>
                                          <option value="<?php echo $r['package_id'];?>"><?php echo $r['package_name'];?> - <?php echo $r['duration'];?> - <?php echo $r['rate'];?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="update_package" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
                          </div>
                      </form>
                      <?php
                  }
                }
              }
                  ?>
                
        </div>
    </div>
</div>

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
                <h3 class="card-title">PACKAGE INFORMATION</h3>
                <!-- <a href ="#" data-toggle="modal" data-target="#main_cat_modal" class="btn btn-primary btn-md float-right">UPDATE PACKAGE</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>PACKAGE BILL ID</th>
      <th>HOTEL NAME</th>
      <th>PACKAGE NAME</th>
      <th>BILL DATE</th>
      <th>START DATE</th>
      <th>END DATE</th>
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
      <td><?php echo $row['hotel_name']; ?></td>
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
</table>         
</div>
</div>
</div>
<?php
include('hotel_footer.php');
?>

