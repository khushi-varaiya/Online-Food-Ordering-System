<?php include("header.php"); ?>
<!DOCTYPE html>
<html>

<head>
  <title>All Time Favorites</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- <link rel="stylesheet" href="css/header_profile.css"> -->
  <style>
    .red-heart {
      color: red;
    }
  </style>
</head>

<body>
  <?php
  include('db.php');
  session_start();
  $mn =  (isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "");
  if (isset($_POST['add_to_cart'])) {

    $item_id = $_POST['item_id'];
    $sqlFetchCart = "SELECT * FROM `add_to_cart` WHERE item_id = $item_id AND mobile_no = '$mn'";
    $queryFetchCart = mysqli_query($conn, $sqlFetchCart);
    $rowFetchCart = mysqli_fetch_row($queryFetchCart);
    if ($rowFetchCart > 0) {
      $sql = "delete from add_to_cart where  item_id = $item_id AND mobile_no = '$mn'";
      $queryDeleteCart = mysqli_query($conn, $sql);

      // $qty++;

      // $sqlAddCart = "UPDATE `add_to_cart` SET `qty`='$qty' WHERE  item_id = $item_id AND mobile_no = '$mn'";
      // $queryAddCart = mysqli_query($conn, $sqlAddCart);
    } else {
      // echo "INSERT INTO `add_to_cart`( `item_id`, `qty`, `mobile_no`) VALUES ('$item_id','1','$mn')";
      $sqlAddCart = "INSERT INTO `add_to_cart`( `item_id`, `qty`, `mobile_no`) VALUES ('$item_id','1','$mn')";
      $queryAddCart = mysqli_query($conn, $sqlAddCart);
      if ($queryAddCart) {
        echo "inserted  .....";
      }
    }
  }
  ?>
  <?php include('header_profile.php') ?>
  <!-- Items section -->
  <section class="my-5">
    <div class="container-fluid">
      <h2 class="header_text text-center" style="font-size:50px;padding-top:100px;">ALL TIME FAVOURITE</h2>
      <div class="row container-fluid" style="padding-top: 10px;">
        <?php
        include("db.php");
        // session_start(); // Start the session
        $sql = "select * from item";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
          $image = $row['image'];
          $name = $row['item_name'];
          $about = $row['about'];
          $price = $row['price'];
          $item_id = $row['item_id'];
          $mobile_no =  $_SESSION['mobile_no'];
          $sqlForF = "select * from favorite where mobile_no = '$mn' and item_id = '$item_id' ";
          $queryForF = mysqli_query($conn, $sqlForF);
          $rowForF = mysqli_fetch_assoc($queryForF);
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6 col-12 container-fluid py-4 px-3">
            <div class="card card_customs">
              <form id="favoriteForm" action="add_to_favorite.php" method="post">
                <img class="card-img-top" src="<?php echo "{$row['image']}"; ?>" height="200px" alt="Card image">
                <input type="hidden" name="image" value="<?php echo $image ?>">
                <input type="hidden" name="name" value="<?php echo $name ?>">
                <input type="hidden" name="about" value="<?php echo $about ?>">
                <input type="hidden" name="price" value="<?php echo $price ?>">
                <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
                <button class="heart-button" type="submit" name="favorite_btn" style="position: absolute; top:4px; right: 6px; padding: 2px; width: 50px; border-radius: 5px; background-color: white;">
                  <i class="fa fa-heart" style="font-size: 25px; margin: 3px; color: <?php if ($rowForF > 1) echo "red"; ?> ;"></i>
                </button>
                <input type="hidden" id="itemId" name="itemId" value="1">

              </form>
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo "{$row['item_name']}"; ?>
                </h5>
                <p class="card-text">
                  <?php echo "{$row['about']}"; ?>
                </p>
                <h5>
                  <?php echo "{$row['price']}" . " Rs/-" ?>
                </h5>
                <form action="" method="POST">
                  <!-- <input type="hidden" name="image" value="<?php echo $image ?>"> -->
                  <input type="hidden" name="item_id" value="<?php echo $item_id =  $row['item_id']; ?>">
                  <!-- <input type="hidden" name="name" value="<?php echo $name ?>"> 
                  <input type="hidden" name="about" value="<?php echo $about ?>">
                  <input type="hidden" name="price" value="<?php echo $price ?>"> 
                  <input type="hidden" name="cart_items" value="<?php echo htmlspecialchars(json_encode($cartItems)); ?>"> 
                   <input type="hidden" name="update_quantity" value="true">  -->
                  <input type="submit" class="btn container-fluid btn_custome" name="add_to_cart" value="Add to cart">
                </form>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    var heartButtons = document.querySelectorAll('.heart-button');
    heartButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var heartIcon = this.querySelector('.fa-heart');
        heartIcon.classList.toggle('red-heart');
        if (heartIcon.classList.contains('red-heart')) {
          // Button is now red
          // Perform additional actions or logic
        } else {
          // Button is not red
          // Perform additional actions or logic
        }
      });
    });
  </script>

</body>

</html>