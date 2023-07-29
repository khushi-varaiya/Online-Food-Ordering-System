<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
?>

<head>
    <link rel="stylesheet" href="Assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="Assets/plugins/toastr/toastr.min.css">
    <script src="Assets/plugins/jquery/jquery.min.js"></script>
    <script src="Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="Assets/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            <?php if (isset($_SESSION['status'])) : ?>
                Toast.fire({
                    icon: 'success',
                    title: '<?php echo $_SESSION['status']; ?>'
                });
                <?php unset($_SESSION['status']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['status'])) : ?>
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="AddpetaSubCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Peta-Sub Category</h1>
                    <button type="button" class="btn-dismiss bg-danger" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid ; border-radius: 2px;">x</button>
                </div>
                <form action="code.php" method="POST" onsubmit="return validateForm()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Peta-Sub Category Name</label>
                            <input type="text" class="form-control" name="pname" id="pname" />
                            <span id="pname_error" class="error"></span>
                        </div>
                        <div class="form-group">
                            <label>Select Sub Category</label>
                            <select name="sname" id="sname">
                                <option value="">-- Select Sub Category --</option>
                                <?php
                                $sql = "select * from sub_category";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option value="<?php echo $row['sub_cat_name']; ?>"><?php echo $row['sub_cat_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            <span id="sname_error" class="error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn bg-success" class="form-control" name="btnAddpetaSubCat" id="btnAddpetaSubCat">Add Peta-Sub Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var petaSubCategoryName = document.getElementById('pname').value.trim();
            var subCategory = document.getElementById('sname').value;
            var isValid = true;

            // Reset error messages
            document.getElementById('pname_error').textContent = '';
            document.getElementById('sname_error').textContent = '';

            // Validate Peta-Sub Category Name
            if (petaSubCategoryName === '') {
                document.getElementById('pname_error').textContent = 'Peta-Sub Category Name is required.';
                document.getElementById('pname_error').style.color = 'red';
                isValid = false;
            }

            // Validate Sub Category selection
            if (subCategory === '') {
                document.getElementById('sname_error').textContent = 'Please select a Sub Category.';
                document.getElementById('sname_error').style.color = 'red';
                isValid = false;
            }

            return isValid;
        }
    </script>



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Peta-Sub Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php" style="color: orange;">Category</a></li>
                        <li class="breadcrumb-item"><a href="subcat.php" style="color: orange;">Peta-Sub Category</a></li>
                        <!-- <li class="breadcrumb-item active">Main Category Details </li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Peta-Sub Category Details</h3>
                        <!-- <?php if (isset($_SESSION['status'])) {

                                    echo "<h6>" . $_SESSION['status'] . "</h6>";
                                    unset($_SESSION['status']);
                                }

                                ?> -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddpetaSubCat" class="btn  float-right btn-sm bg-orange">ADD Peta-Sub Category</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Peta-Sub Category ID</th>
                                    <th>Peta-Sub Category Name</th>
                                    <th>Sub Category Name</th>

                                    <th></th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select s.*, p.* from sub_category s, petasub_category p where p.sub_cat_id = s.sub_cat_id";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {


                                ?>

                                        <tr>


                                            <td><?php echo $row['petasub_cat_id'] ?></td>
                                            <td><?php echo $row['petasub_cat_name'] ?></td>
                                            <td><?php echo $row['sub_cat_name'] ?></td>


                                            <td><a href="petasubcat_Edit.php?petasubcatid=<?php echo $row['petasub_cat_id']; ?> " class="fas fa-marker" style='font-size:20px;color:#3DBA4C'></a></td>

                                            <td><button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_petasub_cat<?php echo $row['petasub_cat_id']; ?>" style="color:red; background-color: transparent; border: none; font-size: 20px;">
                                                    <span class="fas fa-trash-alt"></span>
                                                </button></td>
                                            <!-- Delete Model -->
                                            <!-- -------------------------------------------------------------------------------------------------------- -->
                                            <div class="modal fade" id="delete_petasub_cat<?php echo $row['petasub_cat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_lndmark" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete_petasub_cat">Delete petasub_cat</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="code.php">
                                                                <input type="hidden" name="petasub_cat_id" value="<?php echo $row['petasub_cat_id']; ?>">
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
                                            </div>

                                        </tr>


                                <?php
                                    }
                                }

                                ?>



                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
</div>

<?php
include('includes/script.php');
?>
<script>

</script>


<?php
include('includes/footer.php');
?>