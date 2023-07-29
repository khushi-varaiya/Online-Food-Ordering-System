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

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Discount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="Discount.php" style="color: orange;">Discount</a></li>
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
                        <h3 class="card-title">All Discount Details</h3>
                        <!-- <?php if (isset($_SESSION['status'])) {

                                    echo "<h6>" . $_SESSION['status'] . "</h6>";
                                    unset($_SESSION['status']);
                                }

                                ?> -->
                        <!-- Modal -->
                        <div class="modal fade" id="AddDiscount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Discount</h1>
                                        <button type="button" class="btn-dismiss bg-danger" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid; border-radius: 2px;">x</button>
                                    </div>
                                    <form action="code.php" method="POST" onsubmit="return validateForm()">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Discount Name</label>
                                                <input type="text" class="form-control" name="coupan_code" id="coupan_code" />
                                                <span id="coupan_code_error" class="error" style="color: red;"></span>
                                                <br>
                                                <label>Percetnage</label>
                                                <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" />
                                                <span id="discount_percentage_error" class="error" style="color: red;"></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn bg-success" class="form-control" name="btnAddDiscount" id="btnAddDiscount">Add Discount</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            function validateForm() {
                                var areaName = document.getElementById('coupan_code').value.trim();
                                var areaPercetnage = document.getElementById('discount_percentage').value.trim();
                                var isValid = true;

                                // Reset error messages
                                document.getElementById('coupan_code_error').textContent = '';
                                document.getElementById('discount_percentage_error').textContent = '';

                                // Validate discount name
                                if (areaName === '') {
                                    document.getElementById('coupan_code_error').textContent = 'Discount name is required.';
                                    isValid = false;
                                }

                                // Validate percentage
                                if (areaPercetnage === '') {
                                    document.getElementById('discount_percentage_error').textContent = 'Percetnage is required.';
                                    isValid = false;
                                } else if (!/^\d+$/.test(areaPercetnage)) {
                                    document.getElementById('discount_percentage_error').textContent = 'Percetnage must consist of digits only.';
                                    isValid = false;
                                }

                                return isValid;
                            }
                        </script>

                        <button type="submit" data-bs-toggle="modal" data-bs-target="#AddDiscount" class="btn  float-right btn-sm bg-orange">ADD Discount</bu>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>Discount ID</th>
                                    <th>Coupan Code</th>
                                    <th>Percetage</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select * from discount";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {


                                ?>

                                        <tr>
                                            <?php
                                            $delid = $row['discount_id'];
                                            ?>

                                            <td><?php echo $row['discount_id'] ?></td>
                                            <td><?php echo $row['discount_name'] ?></td>
                                            <td><?php echo $row['percentage'] ?></td>

                                            <td><a href="discount_Edit.php?did=<?php echo $row['discount_id']; ?> " class="fas fa-marker" style='font-size:20px;color:#3DBA4C'></a></td>

                                            <!-- <td><a href="#" class="fas fa-trash-alt deletebtn" style="font-size:20px;color:red; border:none; background:transparent;"></a></td> -->
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_discount<?php echo $row['discount_id']; ?>" style="color:red; background-color: transparent; border: none; font-size: 20px;">
                                                    <span class="fas fa-trash-alt"></span>
                                                </button>
                                                <!-- Delete Model -->
                                                <!-- -------------------------------------------------------------------------------------------------------- -->
                                                <div class="modal fade" id="delete_discount<?php echo $row['discount_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_maincatLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="delete_maincatLabel">Delete Discount</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="code.php">
                                                                    <input type="hidden" name="discount_id" value="<?php echo $row['discount_id']; ?>">
                                                                    <!-- other form fields go here -->
                                                                    <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="discount_delete" class="btn btn-danger">DELETE</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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