<?php include("db.php") ?>
<?php include("header.php") ?>
<?php
session_start();
?>
<html>
  <head>
    <!-- header section end -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- <link rel="stylesheet" href="css/header_profile.css"> -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">

<style>
 .rating {
  display: inline-block;
}

.rating input {
  display: none;
}

.rating label {
  color: #aaa;
  font-size: 30px;
  cursor: pointer;
}

.rating label:hover,
.rating label:hover ~ label,
.rating input:checked ~ label {
  color: #ffcc00;
}

.rating {
  direction: rtl;
}

.rating label {
  direction: ltr;
}
.error{
  color:red;
  font-size:20px !important;
}

  </style>

<script>
function validateForm() {
  var hotel = document.getElementById("hotel").value;
  var mobile = document.getElementById("mobileno").value;
  var rating = document.querySelector("input[name='rating']:checked");

  var hotelError = document.getElementById("hotelError");
  var mobileError = document.getElementById("mobileError");
  var ratingError = document.getElementById("ratingError");

  // Clear previous error messages
  hotelError.innerHTML = "";
  mobileError.innerHTML = "";
  ratingError.innerHTML = "";

  var isValid = true;

  if (hotel === "") {
    hotelError.innerHTML = "Please select a hotel !!!";
    isValid = false;
  }

  if (mobile === "") {
    mobileError.innerHTML = "Please enter your registered mobile number !!!";
    isValid = false;
  }

  if (!rating) {
    ratingError.innerHTML = "Please select a rating !!!";
    isValid = false;
  }

  return isValid;
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
<body>
<div class="container" style="margin-top:100px;">
  <div class="row">
    <div class="col-md-7" style="padding: 20px;">
      <h4>Get in touch</h4>
      <form method="POST" onsubmit="return validateForm();" action="operation_rating.php">
  <div class="mb-3">
    <label for="hotelSelect" class="form-label">HOTEL</label>
    <?php
      $sql = "SELECT * FROM hotel";
      $result = mysqli_query($conn, $sql);
    ?>
    <select name="hotel" id="hotel" class="form-control" style="font-size: 18px;">
      <option value="">-------------------Select HOTEL-------------------</option>
      <?php
        while ($r = mysqli_fetch_array($result)) {
          echo '<option value="' . $r['hotel_id'] . '">' . $r['hotel_name'] . '</option>';
        }
      ?>
    </select>
    <span id="hotelError" class="error"></span>
  </div>
  <div class="mb-3">
    <label for="formGroupExampleInput2" class="form-label">MOBILE NO</label>
    <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Enter your Mobile Number" style="font-size: 18px;">
    <span id="mobileError" class="error"></span>
  </div>
  <div class="mb-3">
    <label for="rating" class="form-label">RATING (RATE FROM 1 TO 5 STARS):- </label>
    <div class="rating" class="form-control">
      <input type="radio" id="star5" name="rating" value="EXCELLENT">
      <label for="star5" style="font-size: 25px;"><i class="far fa-star"></i></label>
      <input type="radio" id="star4" name="rating" value="VERY GOOD">
      <label for="star4" style="font-size: 25px;"><i class="far fa-star"></i></label>
      <input type="radio" id="star3" name="rating" value="GOOD">
      <label for="star3" style="font-size: 25px;"><i class="far fa-star"></i></label>
      <input type="radio" id="star2" name="rating" value="SATISFACTORY">
      <label for="star2" style="font-size: 25px;"><i class="far fa-star"></i></label>
      <input type="radio" id="star1" name="rating" value="POOR">
      <label for="star1" style="font-size: 25px;"><i class="far fa-star"></i></label>
    </div>
    <span id="ratingError" class="error"></span>
  </div>
  <div class="mb-3">
    <label for="feedback" class="form-label">FEEDBACK (OPTIONAL)</label>
    <textarea class="form-control" id="feedback" name="feedback" rows="3" style="font-size: 18px;"></textarea>
  </div>
  <input type="hidden" id="contactus" name="contactus">
  <button class="btn btn-outline-warning">Submit</button>
</form>


    </div>
    <div class="col-md-5" style="background:none;
    padding:2px;
    color: none;">
  <img src="Thank You.jpg" alt="Image Description" height="600px" width="540px">
    </div>
  </div>
</div>


<!-- Latest compiled JavaScript -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->


</body>

</html>
