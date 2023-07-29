<?php
session_start();
?>
<?php
include('hotel_header.php');
include('hotel_navbar.php');
include('hotel_sidebar.php');
?>
<html>
  <head>
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
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

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}
.error{
  color:red;
  font-size:30px;
}

button:hover, a:hover {
  opacity: 0.7;
}
      </style>

<script>

  function validateForm() {
   var hotelName = document.forms["update-form"]["hotel_name"].value;
  var mobileNo = document.forms["update-form"]["mobile_no"].value;
  var area = document.forms["update-form"]["area"].value;
  var landmark = document.forms["update-form"]["landmark"].value;
  var packageName = document.forms["update-form"]["package_name"].value;
  var address = document.forms["update-form"]["address"].value;
  var openTime = document.forms["update-form"]["opentime-dropdown"].value;
  var openDays = document.forms["update-form"]["opendays-dropdown"].value;
  var password = document.forms["update-form"]["password"].value;
  var error = false;
  if (hotelName == "") {
    console.log("HELLO");
    document.getElementById("hotelNameError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("hotelNameError").innerHTML = "";
  }
  if (mobileNo == "") {
    document.getElementById("mobileNoError").innerHTML = "*";
    error = true;
  } else if (!/^[0-9]{10}$/.test(mobileNo)) {
    document.getElementById("mobileNoError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("mobileNoError").innerHTML = "";
  }

  if (area == "") {
    document.getElementById("areaError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("areaError").innerHTML = "";
  }

  if (landmark == "") {
    document.getElementById("landmarkError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("landmarkError").innerHTML = "";
  }

  if (packageName == "") {
    document.getElementById("packageNameError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("packageNameError").innerHTML = "";
  }

  if (address == "") {
    document.getElementById("addressError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("addressError").innerHTML = "";
  }

  if (openTime == "") {
    document.getElementById("openTimeError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("openTimeError").innerHTML = "";
  }

  if (openDays == "") {
    document.getElementById("openDaysError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("openDaysError").innerHTML = "";
  }

  if (password == "") {
    document.getElementById("passwordError").innerHTML = "*";
    error = true;
  } else {
    document.getElementById("passwordError").innerHTML = "";
  }

  if (error) {
    return false; // prevent form submission if there are errors
  }
}
function showDropdown(dropdownId) {
  var area_text_input = document.getElementsByName("area_text")[0];
  var dropdown = document.getElementById(dropdownId);
  dropdown.style.display = "block";
  area_text_input.style.display = "none";
}
function showDropdownl(dropdownId) {
  var landmark_text_input = document.getElementsByName("landmark_text")[0];
  var dropdown = document.getElementById(dropdownId);
  dropdown.style.display = "block";
  landmark_text_input.style.display = "none";
}
function showDropdownt(dropdownId) {
  var opentime_text_input = document.getElementsByName("opentime_text")[0];
  var dropdown = document.getElementById(dropdownId);
  dropdown.style.display = "block";
  opentime_text_input.style.display = "none";
}
function showDropdownd(dropdownId) {
  var opendays_text_input = document.getElementsByName("opendays_text")[0];
  var dropdown = document.getElementById(dropdownId);
  dropdown.style.display = "block";
  opendays_text_input.style.display = "none";
}
function enableForm() {
  
  var form = document.getElementById("update-form");
  var inputs = form.getElementsByTagName("input");
  var updateButton = form.getElementsByTagName("button")[0];
  var submitButton = document.getElementById("submit-button");
  console.log("Enable form clicked");
  submitButton.style.display = "block";

  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].removeAttribute("readonly");
  }   
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = false;
    inputs[i].style.border = "1px solid black";
  }
  updateButton.style.display = "none";
  submitButton.style.display = "block";

  document.getElementById("update-form").reset();
  document.getElementById("hotel-name-error").innerHTML = "";
  document.getElementById("mobile-no-error").innerHTML = "";
  document.getElementById("area-error").innerHTML = "";
  document.getElementById("landmark-error").innerHTML = "";
  document.getElementById("password-error").innerHTML = "";
  document.forms["update-form"]["hotel_name"].removeAttribute("readonly");
  document.forms["update-form"]["mobile_no"].removeAttribute("readonly");
  document.forms["update-form"]["area"].style.display = "inline-block";
  document.forms["update-form"]["area_text"].style.display = "none";
  document.forms["update-form"]["landmark"].style.display = "inline-block";
  document.forms["update-form"]["landmark_text"].style.display = "none";
  document.forms["update-form"]["password"].removeAttribute("readonly");
  document.getElementById("submit-btn").style.display = "inline-block";
}

</script>
</head>

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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">HOTEL PROFILE</h1>
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
    <!-- #################################   WRITE YOUR CODE HERE   #################################### -->
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
  <img src="<?php echo $row['image']; ?>" alt="image" style="width: 100%; height: 400px;">
  <a href="#" style="position: absolute; top: 357px; right:0px; padding: 5px;width:50px;background-color:black;" onclick="document.getElementById('fileInput').click();"><span class="fas fa-pencil-alt" style=" color:white; font-size:20px;"></span></a>
  <input id="fileInput" type="file" name="hotel_image" style="display: none;" onchange="document.getElementById('update-form').submit();">
  </div>
  <p class="title" ><input type="text" name="hotel_name" value="<?php echo $row['hotel_name']; ?>" style="border:none;" readonly><span class="error" id="hotelNameError"></span></p>
  <p>MOBILE NO :- <input type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" style="border:none;" readonly><span class="error" id="mobileNoError"></span></p>
  <p>AREA :- 
  <span style="display:inline-block;">
  <select name="area" id="area-dropdown" style="display:none; width:200px;" >
    <option value="">-------------------Select Area-------------------</option>
    <?php
      $sql="select * from area"; 
      $result=mysqli_query($conn,$sql);
      while($r = mysqli_fetch_array($result))
      {
    ?>
        <option value="<?php echo $r['area_id'];?>" <?php if($r['area_name'] == $row['area_name']){ echo "selected"; } ?>><?php echo $r['area_name'];?></option>
    <?php
      }
    ?>
  </select>
  <input type="text" name="area_text" value="<?php echo $row['area_name']; ?>" style="border:none;" onclick="showDropdown('area-dropdown')" readonly>
  <span class="error" id="areaError"></span>
    </span>
</p>
<p>LANDMARK :- 
<span style="display:inline-block;">
  <select name="landmark" id="landmark-dropdown" style="display:none; width:200px;" >
    <option value="">-------------------Select Landmark-------------------</option>
    <?php
      $sql="select * from landmark";
      $result=mysqli_query($conn,$sql);
      while($r = mysqli_fetch_array($result))
      {
    ?>
        <option value="<?php echo $r['landmark_id'];?>" <?php if($r['landmark_name'] == $row['landmark_name']){ echo "selected"; } ?>><?php echo $r['landmark_name'];?></option>
    <?php
      }
    ?>
  </select>
  <input type="text" name="landmark_text" value="<?php echo $row['landmark_name']; ?>" style="border:none;" onclick="showDropdownl('landmark-dropdown')" readonly>
  <span class="error" id="landmarkError"></span>
    </span>
</p>
  <p>PACKAGE :- <input type="text" name="package_name" value="<?php echo $row['package_name']; ?>" style="border:none;" readonly><span class="error" id="packageNameError"></p>
  <p>ADDRESS :- <input type="text" name="address" value="<?php echo $row['address']; ?>" style="border:none;width:200px;" readonly><span class="error" id="addressError"></span></p>
  <p>OPEN TIME :- 
  <span style="display:inline-block;">
  <select name="open_time" id="opentime-dropdown" style="display:none;width:200px;">
  <option value="">----Select OpenTime----</option>
  <option value="10:00AM TO 10:00PM" <?php if($row['open_time'] == "10:00AM TO 10:00PM") {echo "selected";} ?>>10:00AM TO 10:00PM</option>
  <option value="10:00AM TO 10:30PM" <?php if($row['open_time'] == "10:00AM TO 10:30PM") {echo "selected";} ?>>10:00AM TO 10:30PM</option>
  <option value="10:00AM TO 11:00PM" <?php if($row['open_time'] == "10:00AM TO 11:00PM") {echo "selected";} ?>>10:00AM TO 11:00PM</option>
  <option value="10:00AM TO 11:30PM" <?php if($row['open_time'] == "10:00AM TO 11:30PM") {echo "selected";} ?>>10:00AM TO 11:30PM</option>
  <option value="10:00AM TO 12:00PM" <?php if($row['open_time'] == "10:00AM TO 12:00PM") {echo "selected";} ?>>10:00AM TO 12:00PM</option>
  <option value="06:00PM TO 10:00PM" <?php if($row['open_time'] == "06:00PM TO 10:00PM") {echo "selected";} ?>>06:00PM TO 10:00PM</option>
  <option value="08:00PM TO 10:00PM" <?php if($row['open_time'] == "08:00PM TO 10:00PM") {echo "selected";} ?>>08:00PM TO 10:00PM</option>
</select>
<input type="text" name="opentime_text" value="<?php echo $row['open_time']; ?>" style="border:none;" onclick="showDropdownt('opentime-dropdown')" readonly>
<span class="error" id="openTimeError"></span>
</p>
  <p>OPEN DAYS :- 
  <span style="display:inline-block;">
  <select name="open_days" id="opendays-dropdown" style="display:none;width:200px;">
  <option value="">----Select OpenDays----</option>
  <option value="MON-THU" <?php if ($row['open_days'] == 'MON-THU') { echo 'selected'; } ?>>MON-THU</option>
  <option value="MON-FRI" <?php if ($row['open_days'] == 'MON-FRI') { echo 'selected'; } ?>>MON-FRI</option>
  <option value="MON-SAT" <?php if ($row['open_days'] == 'MON-SAT') { echo 'selected'; } ?>>MON-SAT</option>
  <option value="MON-SUN" <?php if ($row['open_days'] == 'MON-SUN') { echo 'selected'; } ?>>MON-SUN</option>
  <option value="ALTERNATE [MON-WED-FRI-SUN]" <?php if ($row['open_days'] == 'ALTERNATE [MON-WED-FRI-SUN]') { echo 'selected'; } ?>>ALTERNATE [MON-WED-FRI-SUN]</option>
  <option value="ALTERNATE [TUE-THU-SAT-SUN]" <?php if ($row['open_days'] == 'ALTERNATE [TUE-THU-SAT-SUN]') { echo 'selected'; } ?>>ALTERNATE [TUE-THU-SAT-SUN]</option>
</select>
<input type="text" name="opendays_text" value="<?php echo $row['open_days']; ?>" style="border:none;" onclick="showDropdownd('opendays-dropdown')"readonly>
<span class="error" id="openDaysError"></span>
</p>
  <p>PASSWORD:- <input type="password" name="password" value="<?php echo $row['password']; ?>" style="border:none;" readonly><span class="error" id="passwordError"></span></p>
  <p>
    <button type="button" onclick="enableForm()">UPDATE PROFILE</button>
    <button type="submit" name="update_hotel" style="display: none;" id="submit-button">SUBMIT</button>
  </p>
  <input type="hidden" name="update_hotel_id" value="<?php echo $row['hotel_id']; ?>">
 
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
