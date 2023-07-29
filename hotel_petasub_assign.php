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
  function validatePetasubCat() {
    var petasubCat = document.forms["peta_sub_form"]["petasub_cat"].value;
var selectTag = document.forms["peta_sub_form"]["petasub_cat"];
var errorElem = document.getElementById("petasub-cat-error");

if (petasubCat == "") {
  errorElem.innerHTML = "Please select a petasub category !!!";
  errorElem.style.display = "block";
  selectTag.style.border = "2px solid red";
  selectTag.focus();
  return false;
} else {
  errorElem.innerHTML = "";
  errorElem.style.display = "none";
  selectTag.style.border = "";
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
<!-- Modal -->
<div class="modal fade" id="main_cat_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">PETASUB CATEGORY ASSIGN</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <span aria-hidden="true">&times;</span>
      </div>
      <form action="operation_hotel.php" method="post" onsubmit="return validatePetasubCat()" name="peta_sub_form">
      <div id="petasub-cat-error" style="display: none; color: red; text-align: center; margin-top: 10px; font-size: 20px;"></div>
      <div class="modal-body">
       <div class = "form-group">
       <label>SELECT PETASUB CATEGORY :- </label>
                  <?php
                  $sql="select * from petasub_category where sub_cat_id in(select sub_cat_id from sub_category_assign where hotel_id in(select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "'))";
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
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="petasub_cat_assign" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
      </div>
                  </form>
    </div>
  </div>
</div>
    <!-- Content Header (Page header) -->
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
                <h3 class="card-title">PETASUB CATEGORY ASSIGN</h3>
                <a href ="#" data-toggle="modal" data-target="#main_cat_modal" class="btn btn-primary btn-lg float-right">ADD PETASUBCATEGORY</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>PETASUB_CAT_ASSIGN_ID</th>
                    <th>HOTEL_ID</th>
                    <th>PETASUB_CAT_NAME</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                  </tr>
                  </thead>
                  <?php 
                  $query = "SELECT psca.*, h.hotel_name, psc.petasub_cat_name FROM petasub_category_assign psca JOIN hotel h ON psca.hotel_id = h.hotel_id JOIN petasub_category psc ON psca.petasub_cat_id = psc.petasub_cat_id WHERE h.hotel_id IN (SELECT hotel_id FROM hotel WHERE hotel_name = '".$_SESSION['username']."')";
                  $result = mysqli_query($conn, $query);
                  if(mysqli_num_rows($result) > 0) 
                  {
                    foreach($result as $row) 
                    {
                      ?>
                      <tr>
                        <td><?php echo $row['petasub_cat_assign_id']; ?></td>
                        <td><?php echo $row['hotel_name']; ?></td>
                        <td><?php echo $row['petasub_cat_name']; ?></td>
                        <td>
                          <button class="btn btn-success" data-toggle="modal" type="button" data-target="#update_petasubcat<?php echo $row['petasub_cat_assign_id']; ?>" style="border:none; background-color: transparent; color:green; font-size:20px;">
                          <span class="fas fa-marker"></span>
                        </button>
                      </td> 
                      <td>
                        <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_petasubcat<?php echo $row['petasub_cat_assign_id']; ?>" style="border:none; background-color: transparent; color:red; font-size:20px;">
                        <span class="fas fa-trash-alt"></span>
                      </button>
                    </td>
                      <!-- ###############################################   UPDATE MODAL  ################################################## -->
                      <div class="modal fade" id="update_petasubcat<?php echo $row['petasub_cat_assign_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="update_petasubcatLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="update_petasubcatLabel">Update Peta Sub Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="operation_hotel.php">
                              <input type="hidden" name="petasub_cat_assign_id" value="<?php echo $row['petasub_cat_assign_id']; ?>">
                              <!-- other form fields go here -->
                              <label>SELECT PETASUB CATEGORY :- </label>
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
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="petasub_cat_update" class="btn btn-success">Save changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </tr>
                      <!-- ##########################################################    DELETE MODAL   ######################################################### -->
                      <div class="modal fade" id="delete_petasubcat<?php echo $row['petasub_cat_assign_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_petasubcatLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="delete_petasubcatLabel">Delete Pets Sub Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="operation_hotel.php">
                              <input type="hidden" name="petasub_cat_assign_id" value="<?php echo $row['petasub_cat_assign_id']; ?>">
                              <!-- other form fields go here -->
                              <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="petasub_cat_delete" class="btn btn-danger">DELETE</button>
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
                        <td colspan="5" style="text-align: center;">NO RECORD FOUND !!!</td>
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
