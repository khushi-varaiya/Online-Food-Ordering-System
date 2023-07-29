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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<script>
  function validateForm() 
  {
    var itemName = document.forms["item_form"]["itemname"].value;
    var petasubCat = document.forms["item_form"]["petasub_cat"].value;
    var itemImage = document.forms["item_form"]["itemimage"].value;
    var price = document.forms["item_form"]["price"].value;
    var about = document.forms["item_form"]["about"].value;
    var errorFlag = false;
    if (itemName == "") 
    {
      document.getElementById("itemname-error").innerHTML = "Please enter item name !!!";
      errorFlag = true;
    } 
    else 
    {
      document.getElementById("itemname-error").innerHTML = "";
    }
    if (petasubCat == "") 
    {
      document.getElementById("petasub-cat-error").innerHTML = "Please select a petasub category !!!";
      errorFlag = true;
    } else {
      document.getElementById("petasub-cat-error").innerHTML = "";
    }
    if (itemImage == "") {
      document.getElementById("itemimage-error").innerHTML = "Please select an image !!!";
      errorFlag = true;
    } else {
      document.getElementById("itemimage-error").innerHTML = "";
    }
    if (price == "") {
      document.getElementById("price-error").innerHTML = "Please enter price !!!";
      errorFlag = true;
    } else {
      document.getElementById("price-error").innerHTML = "";
    }
    if (about == "") {
      document.getElementById("about-error").innerHTML = "Please enter about item !!!";
      errorFlag = true;
    } else {
      document.getElementById("about-error").innerHTML = "";
    }
    if (errorFlag) {
      return false;
    } else {
      return true;
    }
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
<div class="modal fade" id="main_cat_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">ITEM</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <span aria-hidden="true">&times;</span>
      </div>
      <form action ="operation_hotel.php" method = "post" enctype="multipart/form-data" name="item_form" onsubmit="return validateForm()">
      <div class="modal-body">
       <div class = "form-group">
        <label>ITEM NAME :- </label> <span id="itemname-error" style="color:red;"></span>
        <input type='text' class="form-control input" style="width: 100%;"  placeholder='PLEASE ENTER ITEM NAME !!!' name="itemname">
       
       <label>SELECT PETASUB CATEGORY :- </label><span id="petasub-cat-error" style="color:red;"></span>
                  <?php
                  $sql="select * from petasub_category where petasub_cat_id in(select petasub_cat_id from petasub_category_assign where hotel_id in(select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "'))";
                  $result=mysqli_query($conn,$sql);
                  ?>
                  <select name="petasub_cat" class="form-control select2" style="width: 100%;">
                    <option value = "">-------------------SELECT PETASUB CATEGORY-------------------</option>
                    <?php
                    while($r = mysqli_fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $r['petasub_cat_id'];?>"><?php echo $r['petasub_cat_name'];?></option>
                    <?php
                    }
                    ?>
                    </select>
                    <label>IMAGE :- </label><span id="itemimage-error" style="color:red;"></span>
                    <input type='file' class="form-control input" style="width: 100%;" name="itemimage">
                  <label>PRICE :- </label><span id="price-error" style="color:red;"></span>
                  <input type='number' class="form-control input" style="width: 100%;" placeholder="PLEASE ENTER PRICE !!!" name="price" />
                  <label>ABOUT :- </label><span id="about-error" style="color:red;"></span>
                  <input type='text' class="form-control input" style="width: 100%;" placeholder="PLEASE ENTER ABOUT ITEM !!!" name="about" />
                  
                </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="item" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
      </div>
                  </form>
    </div>
  </div>
</div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">HOTEL DASHBOARD</h1>
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
              <div class="card-header">
                <h3 class="card-title">ITEMS</h3>
                <a href ="#" data-toggle="modal" data-target="#main_cat_modal" class="btn btn-primary btn-lg float-right">ADD ITEMS</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ITEM ID</th>
                    <th>ITEM NAME</th>
                    <th>HOTEL NAME</th>
                    <th>PETASUB CATEGORY</th>
                    <th>IMAGE</th>
                    <th>PRICE</th>
                    <th>ABOUT</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                  </tr>
                  </thead>
                  <?php 
                  $query = "select item.*,h.hotel_name,psc.petasub_cat_name from item JOIN hotel h ON item.hotel_id = h.hotel_id JOIN petasub_category psc ON item.petasub_cat_id = psc.petasub_cat_id WHERE h.hotel_id IN (SELECT hotel_id FROM hotel WHERE hotel_name = '".$_SESSION['username']."')";
                  $result = mysqli_query($conn, $query);
                  if(mysqli_num_rows($result) > 0) 
                  {
                    foreach($result as $row) 
                    {
                      ?>
                      <tr>
                        <td><?php echo $row['item_id']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['hotel_name']; ?></td>
                        <td><?php echo $row['petasub_cat_name']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" alt="Image" width="100" height="100"></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['about']; ?></td>
                        <td>
                          <button class="btn btn-success" data-toggle="modal" type="button" data-target="#update_item<?php echo $row['item_id']; ?>" style="border:none; background-color: transparent; color:green; font-size:20px;">
                          <span class="fas fa-marker"></span>
                          </button>
                        </td> 
                        <td>
                          <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_item<?php echo $row['item_id']; ?>" style="border:none; background-color: transparent; color:red; font-size:20px;">
                          <span class="fas fa-trash-alt"></span>
                          </button>
                        </td>
                      <!-- ####################################################################         UPDATE MODAL        ####################################################################-->
          <div class="modal fade" id="update_item<?php echo $row['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="update_item" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="update_item">Update Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class = "form-group">
              <form action ="operation_hotel.php" method = "post" enctype="multipart/form-data">
              <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
              <?php
              $sql_item = "SELECT * FROM item WHERE item_id = '".$row['item_id']."'";
              $sql_result = mysqli_query($conn, $sql_item);
              $item_row = mysqli_fetch_assoc($sql_result);
              ?>
              <label>ITEM NAME:</label> <span id="itemname-error" style="color: red;"></span>
              <input type="text" class="form-control input" style="width: 100%;" placeholder="PLEASE ENTER ITEM NAME !!!" name="itemname" value="<?php echo $item_row['item_name']; ?>">
                  <label>SELECT PETASUB CATEGORY :- </label><span id="petasub-cat-error" style="color:red;"></span>
                  <?php
                  $sql="select * from petasub_category where sub_cat_id in(select sub_cat_id from sub_category_assign where hotel_id in(select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "'))";
                  $result=mysqli_query($conn,$sql);
                  ?>
                  <select name="petasub_cat_u" class="form-control select2" style="width: 100%;">
                  <option value="">-------------------SELECT PETASUB CATEGORY-------------------</option>
                  <?php
                  while($r = mysqli_fetch_array($result))
                  {
                      $selected = ($r['petasub_cat_name'] == $row['petasub_cat_name']) ? 'selected' : '';
                      ?>
                      <option value="<?php echo $r['petasub_cat_id'];?>" <?php echo $selected ?>><?php echo $r['petasub_cat_name'];?></option>
                      <?php
                  }
                    ?>
                  </select>
                    <label>IMAGE :- </label><span id="itemimage-error" style="color:red;"></span>
                    <input type='file' class="form-control input" style="width: 100%; height:40px;" name="itemimage" value="<?php echo $item_row['image']; ?>"">
                  <label>PRICE :- </label><span id="price-error" style="color:red;"></span>
                  <input type='number' class="form-control input" style="width: 100%;" placeholder="PLEASE ENTER PRICE !!!" name="price" value="<?php echo $item_row['price']; ?>"/>
                  <label>ABOUT :- </label><span id="about-error" style="color:red;"></span>
                  <input type='text' class="form-control input" style="width: 100%;" placeholder="PLEASE ENTER ABOUT ITEM !!!" name="about" value="<?php echo $item_row['about']; ?>" />
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="item_update" class="btn btn-success">SAVE CHANGES</button>
            </div>
          </form>
              </div>
            </div>
          </div>
        </tr>
        <!-- ####################################################################         DELETE MODAL        ####################################################################-->
        <div class="modal fade" id="delete_item<?php echo $row['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_item" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="delete_item">Delete Main Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="post" action="operation_hotel.php">
                <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                <!-- other form fields go here -->
                <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="item_delete" class="btn btn-danger">DELETE</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
                      <?php
                      }
                    } 
                    else 
                    {
                      ?>
                      <tr>
                        <td colspan="9" style="text-align: center;">NO RECORD FOUND !!!</td>
                    </tr>
                    <?php
                    }
                    ?>
</table>
</div>
</div>

</div>
<?php
include('hotel_footer.php');
?>
