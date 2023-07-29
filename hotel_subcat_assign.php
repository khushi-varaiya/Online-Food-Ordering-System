<?php
include('conn.php');
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
function validateForm() {
  var subCat = document.forms["sub_cat_form"]["sub_cat"].value;
  var selectTag = document.forms["sub_cat_form"]["sub_cat"];
  var errorElem = document.getElementById("sub-cat-error");
  
  if (subCat == "") {
    errorElem.innerHTML = "Please select a sub category !!!";
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
        <h3 class="modal-title" id="exampleModalLabel">SUB CATEGORY ASSIGN</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <span aria-hidden="true">&times;</span>
      </div>
      <form action="operation_hotel.php" method="post" name="sub_cat_form" onsubmit="return validateForm()">
      <div id="sub-cat-error" style="display: none; color: red; text-align: center; margin-top: 10px; font-size: 24px;"></div>
      <div class="modal-body">
       <div class = "form-group">
       <label>SELECT SUB CATEGORY :- </label>
                  <?php
                  $sql="select * from sub_category where main_cat_id in(select main_cat_id from main_category_assign where hotel_id in(select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "'))";
                  $result=mysqli_query($conn,$sql);
                  ?>
                  <select name="sub_cat" class="form-control select2" style="width: 100%;">
                    <option value = "">-------------------SELECT SUB CATEGORY-------------------</option>
                    <?php
                    while($r = mysqli_fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $r['sub_cat_id'];?>"><?php echo $r['sub_cat_name'];?></option>
                    <?php
                    }
                    ?>
                    </select>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="sub_cat_assign" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
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
                <h3 class="card-title">SUB CATEGORY ASSIGN</h3>
                <a href ="#" data-toggle="modal" data-target="#main_cat_modal" class="btn btn-primary btn-lg float-right">ADD SUB CATEGORY</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SUB_CAT_ASSIGN_ID</th>
                    <th>HOTEL_ID</th>
                    <th>SUB_CAT_NAME</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                  </tr>
                  </thead>
                  <?php 
                  $query = "SELECT sca.*, h.hotel_name, sc.sub_cat_name FROM sub_category_assign sca JOIN hotel h ON sca.hotel_id = h.hotel_id JOIN sub_category sc ON sca.sub_cat_id = sc.sub_cat_id WHERE h.hotel_id IN (SELECT hotel_id FROM hotel WHERE hotel_name = '".$_SESSION['username']."')";
                  $result = mysqli_query($conn, $query);
                  if(mysqli_num_rows($result) > 0) 
                  {
                    foreach($result as $row) 
                    {
                      ?>
                      <tr>
                        <td><?php echo $row['sub_cat_assign_id']; ?></td>
                        <td><?php echo $row['hotel_name']; ?></td>
                        <td><?php echo $row['sub_cat_name']; ?></td>
                        <td>
                          <button class="btn btn-success" data-toggle="modal" type="button" data-target="#update_subcat<?php echo $row['sub_cat_assign_id']; ?>" style="border:none; background-color: transparent; color:green; font-size:20px;">
                          <span class="fas fa-marker"></span>
                        </button>
                      </td> 
                      <td>
                         <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_subcat<?php echo $row['sub_cat_assign_id']; ?>" style="border:none; background-color: transparent; color:red; font-size:20px;">
                         <span class="fas fa-trash-alt"></span>
                        </button>
                      </td>
                      <div class="modal fade" id="update_subcat<?php echo $row['sub_cat_assign_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="update_subcatLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="update_subcatLabel">Update Sub Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="operation_hotel.php">
                              <input type="hidden" name="sub_cat_assign_id" value="<?php echo $row['sub_cat_assign_id']; ?>">
                              <!-- other form fields go here -->
                              <label>SELECT SUB CATEGORY :- </label>
                              <?php
                              $sql="select * from sub_category where main_cat_id in(select main_cat_id from main_category_assign where hotel_id in(select hotel_id from hotel where hotel_name = '" . $_SESSION['username'] . "'))";
                              $result=mysqli_query($conn,$sql);
                               ?>
                               <select name="sub_cat_u" class="form-control select2" style="width: 100%;">
                               <option value="">-------------------SELECT MAIN CATEGORY-------------------</option>
                               <?php
                               while($r = mysqli_fetch_array($result))
                               {
                                $selected = ($r['sub_cat_name'] == $row['sub_cat_name']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $r['sub_cat_id'];?>" <?php echo $selected ?>><?php echo $r['sub_cat_name'];?></option>
                                <?php
                                }
                                ?>
                                </select>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="sub_cat_update" class="btn btn-success">Save changes</button>
                                </div>
                              </form>
                            </div>
                           </div>
                           </div>
                           </tr>
                           <!-- #####################################################   DELETE MODAL   ######################################################## -->
                           <div class="modal fade" id="delete_subcat<?php echo $row['sub_cat_assign_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_subcatLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="delete_subcatLabel">Delete Sub Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="operation_hotel.php">
                                  <input type="hidden" name="sub_cat_assign_id" value="<?php echo $row['sub_cat_assign_id']; ?>">
                                  <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="sub_cat_delete" class="btn btn-danger">DELETE</button>
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
