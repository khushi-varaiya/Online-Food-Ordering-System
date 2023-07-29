<?php include "header.php" ?>
<html>
<head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="../HOTEL/plugins/jquery/jquery.min.js"></script>
  <script src="../HOTEL/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
  <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_maincat" style="border:none; background-color: transparent; color:red; font-size:100px; margin-top:500px;">
    <span class="fas fa-trash-alt"></span>
  </button>
  <a href="#" class="btn btn-warning rounded-pill py-2 btn-block" data-toggle="modal" data-target="#delete_maincat">Proceed to checkout</a>
  <div class="modal fade" id="delete_maincat" tabindex="-1" role="dialog" aria-labelledby="delete_maincatLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delete_maincatLabel">Delete Main Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="operation_hotel.php">
            <input type="hidden" name="main_cat_assign_id" value="">
            <!-- other form fields go here -->
            <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="main_cat_delete" class="btn btn-danger">DELETE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


if (mysqli_num_rows($query) == 0) {
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 550px;">
                  <img src="images/CART.png" alt="NO ITEM IN THE CART !!!" style="height: 400px; width: 700px;">
                  </div>
                  <div style="margin-top:-40px;margin-left:700px;width:300px;" class="btn btn-warning rounded-pill btn-block">
                      <a href="item.php" style="background:none;border:none;color:black;font-size:20px;" class="btn btn-primary">ADD ITEMS</a>
                  </div>
                  ';
    }    
