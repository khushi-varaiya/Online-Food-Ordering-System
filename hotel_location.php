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
  <head>
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 1000px;
  margin: auto;
  text-align: center;
}

.title {
  color: black;
  font-size: 30px;
  align-items: center;
}
button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
      </style>

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
            <h1 class="m-0 text-dark">HOTEL LOCATION</h1>
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
    <?php 
    
    $query = "SELECT hotel.*, area.area_name,landmark.landmark_name,package.package_name FROM hotel JOIN landmark ON hotel.landmark_id = landmark.landmark_id JOIN package ON hotel.package_id = package.package_id JOIN area ON hotel.area_id = area.area_id WHERE hotel.hotel_name = '".$_SESSION['username']."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) 
    {
      foreach($result as $row) 
      {
        ?>
  <form id="update-form" method="post" action="operation_hotel.php" enctype="multipart/form-data" onsubmit="return validateForm()">
  <div style="position: relative;">
  <img src="<?php echo $row['map']; ?>" alt="image" style="width: 100%; height:500px;">
  <a href="#" style="position: absolute; top: 483px; right:0px; padding: 5px; width:100%; background-color:black;" onclick="document.getElementById('fileInput').click();"><span class="fas fa-pencil-alt" style=" color:white; font-size:20px;"> EDIT LOCATION</span></a>
  <input id="fileInput" type="file" name="hotel_map" style="display: none;" onchange="document.getElementById('update-form').submit();">
  </div>
  <p>
     <button type="submit" name="update_hotel" style="display: none;" id="submit-button">SUBMIT</button>
  </p>
  <input type="hidden" name="update_hotel_id" value="<?php echo $row['hotel_id']; ?>">
  <input type="hidden" name="hotel_name" value="<?php echo $row['hotel_name']; ?>">
</form>

  <?php
  }
} 
 ?>
</div>
</div>
<?php
include('hotel_footer.php');
?>

