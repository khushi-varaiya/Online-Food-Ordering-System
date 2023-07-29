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
    <div class="modal fade" id="AddLandmark" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add LandMark</h1>
                    <button type="button" class="btn-dismiss bg-danger" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid ; border-radius: 2px;">x</button>
                </div>
                <form action="code.php" method="POST" onsubmit="return validateForm()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>LandMark Name</label>
                            <input type="text" class="form-control" name="landmarkname" id="landmarkname" />
                            <span id="landmarkname_error" class="error"></span>
                            <br />
                            <label>Select Area Name</label><br />
                            <select name="areaname" id="areaname">
                                <option value="">--Select Area--</option>
                                <?php
                                $sql = "select * from area";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option value="<?php echo $row['area_name']; ?>"><?php echo $row['area_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn bg-success" class="form-control" name="btnAddLandmark" id="btnAddLandmark">Add Landmark</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var landmarkName = document.getElementById('landmarkname').value.trim();
            var areaName = document.getElementById('areaname').value;
            var isValid = true;

            // Reset error messages
            document.getElementById('landmarkname_error').textContent = '';

            // Validate landmark name
            if (landmarkName === '') {
                document.getElementById('landmarkname_error').textContent = 'Landmark name is required.';
                document.getElementById('landmarkname_error').style.color = 'red';
                isValid = false;
            }

            // Validate area name
            if (areaName === '') {
                // Display error message in red color
                var areaError = document.createElement('span');
                areaError.textContent = 'Please select an area.';
                areaError.style.color = 'red';
                document.getElementById('areaname').parentNode.appendChild(areaError);
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
                    <h1 class="m-0 text-dark">LandMark</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="landmark.php" style="color: orange;">LandMark</a></li>
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
                        <h3 class="card-title">All LandMark Details</h3>
                        <!-- <?php if (isset($_SESSION['status'])) {

                                    echo "<h6>" . $_SESSION['status'] . "</h6>";
                                    unset($_SESSION['status']);
                                }

                                ?> -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddLandmark" class="btn  float-right btn-sm bg-orange">ADD LandMark</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="bg-orange">
                                <tr>
                                    <th>LandMark ID</th>
                                    <th>LandMark Name</th>
                                    <th>Area Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "select l.*, a.* from landmark l , area a where a.area_id = l.area_id";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {


                                    while ($row = mysqli_fetch_array($result)) {


                                ?>

                                        <tr>
                                            <?php
                                            $delid = $row['landmark_id'];
                                            ?>

                                            <td><?php echo $row['landmark_id'] ?></td>
                                            <td><?php echo $row['landmark_name'] ?></td>
                                            <td><?php echo $row['area_name'] ?></td>

                                            <td><a href="landmark_Edit.php?landmarkid=<?php echo $row['landmark_id']; ?> " class="fas fa-marker" style='font-size:20px;color:#3DBA4C'></a></td>
                                            <td><button class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete_landmark<?php echo $row['landmark_id']; ?>" style="color:red; background-color: transparent; border: none; font-size: 20px;">
                                                    <span class="fas fa-trash-alt"></span>
                                                </button></td>
                                            <!-- Delete Model -->
                                            <!-- -------------------------------------------------------------------------------------------------------- -->
                                            <div class="modal fade" id="delete_landmark<?php echo $row['landmark_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="delete_lndmark" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete_landmark">Delete Landmark</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="code.php">
                                                                <input type="hidden" name="landmark_id" value="<?php echo $row['landmark_id']; ?>">
                                                                <!-- other form fields go here -->
                                                                <label>ARE YOU SURE YOU WANT TO DELETE ?</label>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="landmark_delete" class="btn btn-danger">DELETE</button>
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