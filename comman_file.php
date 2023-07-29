<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Set recipient email address
  $to = 'patelkhushishailesh@gmail.com';

  // Set email subject
  $subject = 'New Contact Form Submission';

  // Email content
  $body = "Name: $name\n";
  $body .= "Email: $email\n";
  $body .= "Message: $message\n";

  // Set additional headers
  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send the email
  if (mail($to, $subject, $body, $headers)) {
    echo '<div class="alert alert-success">Email sent successfully!</div>';
  } else {
    echo '<div class="alert alert-danger">An error occurred while sending the email.</div>';
  }
}
?>

<div class="col-lg-3 col-6">
          <?php
          $ratting = 0;
                include('conn.php');
                $query = "SELECT Count(rate_id) as rate_count from rate_hotel where hotel_id in (select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "')";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) 
                {
                  $row = mysqli_fetch_assoc($result);
                  $ratting = $row['rate_count'];
                }
                ?>
            <div class="small-box bg-white">
              <div class="inner">
                <h3><?php echo $ratting; ?></h3>

                <p>RATING</p>
              </div>
              <div class="icon">
                <i class="ion ion-spoon"></i>
              </div>
              <a href="hotel_ratting.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
              </div>