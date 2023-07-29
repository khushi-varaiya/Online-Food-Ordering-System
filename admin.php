<?php
session_start();
echo $_SESSION['username'] ;
echo $_SESSION['password'] ;
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
    .modal {
  display: flex;
  justify-content: center;
  align-items: center;
}

    </style>
</head>

    </html>
<?php
if(isset($_SESSION['username'])) 
{
    echo "<div class='modal fade' id='welcomeModal' tabindex='-1' role='dialog' aria-labelledby='welcomeModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='welcomeModalLabel'>Welcome, " . $_SESSION['username'] . "!</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <p>You have successfully logged in as an admin.</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>";

    echo "<script>
            $(document).ready(function(){
                $('#welcomeModal').modal('show');
            });
        </script>";
}
?>
