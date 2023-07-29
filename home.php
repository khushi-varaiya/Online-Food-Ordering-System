<?php include("header.php") ?>

<!-- carausal start -->
<div id="demo" class="carousel slide " data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>

  <!-- The slideshow/carousel -->

  <div class="carousel-inner carosal_custom">
    <div class="carousel-item active">
      <img src="Images/33.jpg" alt="Los Angeles" class="d-block" style="width:100%">
      <div class="carousel-caption slide1">
        <h1>Our Popular Food On Your Way!!</h1>
        <h3>We had such a great time in LA!</h3>
      </div>

    </div>
    <div class="carousel-item">
      <img src="Images/11.jpg" alt="Chicago" class="d-block" style="width:100%">
      <div class="carousel-caption slide1">
        <h1>Our Popular Food On Your Way!!</h1>
        <h3>We had such a great time in LA!</h3>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Images/22.jpg" alt="New York" class="d-block" style="width:100%">
      <div class="carousel-caption slide1">
        <h1>Our Popular Food On Your Way!!</h1>
        <h3>We had such a great time in LA!</h3>
      </div>
    </div>
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<section class="my-3">
  <div class="py-5">
    <h2 class="header_text text-center">About Your Bites</h2>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <img src="Images/55.jpg" alt="" style="margin-left: -100px;" class="img-fluid img_view_more" />
      </div>
      <div class="col-lg-6 col-md-6 col-12">
        <h2 class="display-6" style="color:rgb(6, 77, 14); font-size: 40px;">Your Perfect Destination For Any Occasion
        </h2>
        <p class="py-3" style="font-size: 15px;">"Find great deals and discounts on your favorite dishes, and discover
          new restaurants to try out
          in your area.Discover the best food ordering experience with our platform, featuring a vast selection of
          top-rated restaurants.Satisfy your cravings with a wide selection of cuisines and dishes available for
          delivery.Find everything from quick snacks to full meals on our platform, and enjoy a hassle-free ordering
          experience every time."</p>
        <a href="item.php" class="btn  btn_custome" style="width: 55%; margin-left: 140px; font-size: 26px;">
          Explore More>>
        </a>
      </div>
    </div>

  </div>
</section>

<!-- show all hotels -->

<section class="my-5">
  <div class="py-4">
    <h2 class="header_text text-center">All Time Favorites</h2>
  </div>
  <div class="container-fluid">
    <div class="row container-fluid">
      <?php
      include("db.php");
      $sql = "SELECT * FROM hotel";
      $query = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($query)) {
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 container-fluid py-4 px-3">
          <div class="card card_customs">
            <img class="card-img-top" src="<?php echo $row['image'] ?>" height="220px" alt="Card image">
            <div class="card-body" style="font-size: 15px;">
              <h5 class="card-title" style="font-size: 21px;">
                <?php echo $row['hotel_name']; ?>
              </h5>
              <a href="menu.php?hotel_id=<?php echo $row['hotel_id']; ?>" class="btn container-fluid btn_custome">View
                Menu</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- footer -->
<!-- -->
</body>

</html>