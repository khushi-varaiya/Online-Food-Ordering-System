<?php
include "conn.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>TASTY TRACK</title>
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <script src="validation.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet">
    <style>
        .error-message {
            color: black !important;
            font-size: 15px;
            align-items: center !important;
        }
        .full-page {
            height: 120%;
            width: 100%;
            /* background-color: white; */
            /* background-color: #fd7e14; */
            background-image: url(login1.jpg);
            background-size: 1600px 830px !important; /* Set the desired height and width */
            /* background-position: center;linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), */
            background-size: cover;
            background-repeat: no-repeat;
            position: absolute;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            padding: 20px;
            padding-left: 50px;
            padding-right: 30px;
            padding-top: 5px;
        }

        .form-box {
            width: 420px;
            height: 780px;
            /* position: sticky; */
            position: relative;
            margin: auto;
            background: transparent;
            padding: 0px;
            overflow: hidden;
            box-shadow: -1px 1px 20px 0px #5a5857c1;
            /* box-shadow: -1px 1px 20px 6px #5a5857c1; */
            /* box-shadow: 0 0 50px 15px #f96931c1; */
            margin-left: 82px;
        }

        .button-box {
            width: 330px;
            margin: 30px;
            position: relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
        }

        .toggle-btn {
            padding: 10px 23px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
            color: black;
        }

        #btn {
            top: 0;
            left: 0;
            position: absolute;
            width: 100px;
            height: 100%;
            background: #fd7e14;
            border-radius: 30px;
            transition: .5s;
        }

        .input-group-login {
            top: 150px;
            position: absolute;
            width: 280px;
            transition: .5s;
        }

        .input-group-user {
            top: 150px;
            position: absolute;
            width: 280px;
            transition: .5s;
        }

        .input-group-hotel {
            top: 100px;
            position: absolute;
            width: 280px;
            transition: .5s;
        }

        .input-field {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;
        }

        .submit-btn {
            width: 85%;
            padding: 10px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: #fd7e14;
            border: 0;
            outline: none;
            border-radius: 30px;
        }

        .check-box {
            margin: 0px 10px 34px 0;
        }

        span {
            color: #777;
            font-size: 12px;
            bottom: 68px;
            position: absolute;
        }

        #login {
            left: 50px;
        }

        #login input {
            color: #777;
            font-size: 15;
        }

        #user {
            left: 450px;
        }

        #user input {
            color: #777;
            font-size: 15;
        }

        #hotel {
            left: 450px;
        }

        #hotel input {
            color: #777;
            font-size: 15;
        }

        #hotel label {
            color: #777;
            font-size: 15;
        }

        select {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            outline: none;
            background: transparent;
            color: #777;
        }

        option {
            color: black;
        }

        .error {
            color: red;
        }

        .error1 {
            color: red;
        }

        .error2 {
            color: red;
        }

        .forget-password-link {
            display: block;
            padding: 10px;
            margin-top: -20px;
            text-decoration: none;
            color: #777;
            background-color: transparent;
            border: none;
            font-size: 17px;
            font-family: "Times New Roman", Times, serif;
        }

        .checkbox-container {
            display: inline-block;
        }

        .checkbox-container label {
            display: inline-block;
            margin-left: 0px;
            margin-top: 0px;
            vertical-align: middle;
            color: #777;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 5.7%;
            width: 400px;
            height: 300px;
            background: #b1adad;
            z-index: 9999;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
        }

        .popup-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            font-size: 20px;
            height: 100%;
            width: 100%;
            color: black;
            padding-top: 20px;
            padding-bottom: 40px;
            padding-left: 0px;
            padding-right: 25px;
        }

        .popup-input {
            width: 300PX;
            margin: 5px auto;
            border: 0;
            border-bottom: 1px solid #999;
            outline: none;
            text-align: center;
            padding-top: 20px;
            font-size: 15px;
            color: black !important;
        }

        .popup-button {
            height: 40px;
            width: 100px;
            background-color: white;
            margin-left: 100px;
            margin-top: 10px;
        }
    </style>
    <script src="validation.js"></script>
    <script>
        function openPopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "block";
        }

        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
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
            <?php if (isset($_SESSION['success_message'])) : ?>
                Toast.fire({
                    icon: 'success',
                    title: '<?php echo $_SESSION['success_message']; ?>'
                });
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['warning_message'])) : ?>
                Toast.fire({
                    icon: 'warning',
                    title: '<?php echo $_SESSION['warning_message']; ?>'
                });
                <?php unset($_SESSION['warning_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['failed_message'])) : ?>
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
    <div id="popup" class="popup">
        <div class="popup-content">
            <h2 style="border-bottom: 1px solid #999;">Reset Password</h2>
            <button class="close-button" onclick="closePopup()">X</button> <!-- Close button -->
            <form method="POST" id="resetpassword" enctype="multipart/form-data" action="operation.php">
                <input type="text" id="mobileNumber" name="mobileNumber" placeholder="Enter registered mobile number" class="popup-input">
                <div id="mobileNumberError" class="error-message"></div>
                <input type="password" id="password" name="password" placeholder="Enter new password" class="popup-input">
                <div id="passwordError" class="error-message"></div>
                <input type="password" id="cpassword" name="cpassword" placeholder="Enter confirm password" class="popup-input">
                <div id="cpasswordError" class="error-message"></div>
                <button type="submit" onclick="return validateForm()" class="popup-button" name="resetpassword">NEXT</button>
            </form>
        </div>
    </div>



    <div class="full-page">
        <div class="navbar">
            <nav>
                <!-- <ul>
            <li><button class='loginbtn' onclick="document.getElementById('login-form').style.display='block'" style="width:auto;">Login</button></li>
            </ul> -->
            </nav>
        </div>
        <div class='login-page'>
            <div class="form-box">
                <div class='button-box'>
                    <div id='btn'></div>
                    <button type='button' onclick='login()' class='toggle-btn'>LOGIN</button>
                    <button type='button' onclick='user()' class='toggle-btn'>REGISTER<br>USER</button>
                    <button type='button' onclick='hotel()' class='toggle-btn'>REGISTER<br>HOTEL</button>
                </div>

                <form id='login' class='input-group-login' method="POST">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='error'>" . $_GET['error'] . "</div>";
                    }
                    ?>
                    <input type='text' class='input-field' placeholder='Mobile Number' name="mobilenol">
                    <div class="error"></div>
                    <input type='password' class='input-field' placeholder='Enter Password' name="passwordl">
                    <div class="error"></div>
                    <div class="checkbox-container">
                        <input type="checkbox" class="check-box" id="remember" name="remember"><label for="remember">Remember Password</label>
                    </div>
                    <!-- <a href="#" class="forget-password-link">Forget Password ?</a> -->
                    <button class="forget-password-link" type="button" name="forget_password" onclick="openPopup()">Forget password ?</button>
                    <button type='submit' class='submit-btn' name='login' onclick='return validatelogin()'>LOGIN</button>
                </form>

                <form id='user' class='input-group-user' method="POST">
                    <input type='text' class='input-field' placeholder='First Name' name="firstname">
                    <div class="error1"></div>
                    <input type='text' class='input-field' placeholder='Last Name' name="lastname">
                    <div class="error1"></div>
                    <input type='text' class='input-field' placeholder='Mobile no' name="mobilenou">
                    <div class="error1"></div>
                    <select name="gender">
                        <option value="">-------------------Select Gender-------------------</option>
                        <option>FEMALE</option>
                        <option>MALE</option>
                    </select>
                    <div class="error1"></div>
                    <input type='email' class='input-field' placeholder='Email Id' name="email">
                    <div class="error1"></div>
                    <input type='password' class='input-field' placeholder='Enter Password' name="passwordu">
                    <div class="error1"></div>
                    <input type='password' class='input-field' placeholder='Confirm Password' name="confirmpasswordu">
                    <div class="error1"></div>
                    <input type="hidden" name="user" value="register_user">
                    <button type='submit' class='submit-btn' name='user' onclick='return login1()'>REGISTER USER</button>
                </form>


                <form id='hotel' class='input-group-hotel' method="post" enctype="multipart/form-data">
                    <input type='text' class='input-field' placeholder='Hotel Name' name="hotelname">
                    <div class="error2"></div>
                    <input type='text' class='input-field' placeholder='Mobile Number' name="mobilenoh">
                    <div class="error2"></div>
                    <input type='password' class='input-field' placeholder='Password' name="passwordh">
                    <div class="error2"></div>
                    <input type='password' class='input-field' placeholder='Confirm Password' name="confirmpasswordh">
                    <div class="error2"></div>
                    <?php
                    $sql = "select * from area";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <select name="area">
                        <option value="">-------------------Select Area-------------------</option>
                        <?php
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $r['area_id']; ?>"><?php echo $r['area_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="error2"></div>
                    <?php
                    $sql = "select * from landmark";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <select name="landmark">
                        <option value="">-------------------Select Landmark-------------------</option>
                        <?php
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $r['landmark_id']; ?>"><?php echo $r['landmark_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="error2"></div>
                    <?php
                    $sql = "select * from package";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <select name="package">
                        <option value="">-------------------Select Package-------------------</option>
                        <?php
                        while ($r = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $r['package_id']; ?>"><?php echo $r['package_name']; ?> - <?php echo $r['duration']; ?> - <?php echo $r['rate']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="error2"></div>
                    <label>Hotel Image:-</label><input type='file' class='input-field' placeholder='Image' name="hotelimage">
                    <div class="error2"></div>
                    <input type='text' class='input-field' placeholder='Address' name="address">
                    <div class="error2"></div>
                    <label>Hotel Map:-</label><input type='file' class='input-field' placeholder='Map' name="hotelmap">
                    <div class="error2"></div>
                    <select name="opentime">
                        <option value="">-------------------Select OpenTime-------------------</option>
                        <option>10:00AM TO 10:00PM</option>
                        <option>10:00AM TO 10:30PM</option>
                        <option>10:00AM TO 11:00PM</option>
                        <option>10:00AM TO 11:30PM</option>
                        <option>10:00AM TO 12:00PM</option>
                        <option>06:00PM TO 10:00PM</option>
                        <option>08:00PM TO 10:00PM</option>
                    </select>
                    <div class="error2"></div>
                    <select name="openDays">
                        <option value="">-------------------Select OpenDays-------------------</option>
                        <option>MON-THU</option>
                        <option>MON-FRI</option>
                        <option>MON-SAT</option>
                        <option>MON-SUN</option>
                        <option>ALTERNATE [MON-WED-FRI-SUN]</option>
                        <option>ALTERNATE [TUE-THU-SAT-SUN]</option>
                    </select>
                    <div class="error2"></div>
                    </br>
                    <input type="hidden" name="hotel" value="register_hotel">
                    <button type='submit' class='submit-btn' name='hotel' onclick='return validatehotel()'>REGISTER HOTEL</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var a = document.getElementById('login');
        var b = document.getElementById('user');
        var c = document.getElementById('hotel');
        var d = document.getElementById('btn');

        function hotel() {
            a.style.left = '-400px';
            b.style.left = '-550px';
            c.style.left = '50px';
            d.style.left = '220px';
        }

        function user() {
            a.style.left = '-400px';
            b.style.left = '50px';
            c.style.left = '550px';
            d.style.left = '100px';
        }

        function login() {
            a.style.left = '50px';
            b.style.left = '450px';
            c.style.left = '450px';
            d.style.left = '0px';
        }
    </script>
    <script>
        var modal = document.getElementById('login-form');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>