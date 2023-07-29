<?php include("db.php") ?>
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if(isset($_POST['contactus']))
    {
        // echo "HELLO";
        $hotelid = $_POST['hotel'];
        $mobileno = $_POST['mobileno'];
        $rating = $_POST['rating'];
        $feedback = $_POST['feedback'];

        $resulth = mysqli_query($conn, "SELECT MAX(rate_id) as last_id FROM rate_hotel");
        $rowh = mysqli_fetch_assoc($resulth);
        $last_id = $rowh['last_id'];
            
        $next_id = $last_id + 1;

        $check_mn = "SELECT * FROM user WHERE mobile_no = '$mobileno'";
        $check_result = mysqli_query($conn, $check_mn);
        if(mysqli_num_rows($check_result) > 0)
        {
            $insert_rating = "INSERT INTO `rate_hotel`(`rate_id`, `hotel_id`, `mobile_no`, `rating`, `feedback`) VALUES ('$next_id','$hotelid','$mobileno','$rating','$feedback')";
            $rating_result = mysqli_query($conn, $insert_rating);
            if($rating_result)
            {
                $_SESSION['success_message'] = 'THANK YOU FOR YOUR VALUEABLE FEEDBACK !!!';
                header('Location: contactus.php');
            }       
            else
            {
                $_SESSION['warning_message'] = 'SORRY YOUR FEEDBACK WAS NOT RECIEVED !!!';
                header('Location: contactus.php');
            }
        }
        else
        {
            $_SESSION['warning_message'] = 'WE REQUEST YOU TO LOGIN FIRST OR ENTER YOUR REGISTERED MOBILE NO !!!';
            header('Location:contactus.php');
        }
        
    }
}
?>