<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');

?>


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Landmark</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="landmark.php" style="color: orange;">Landmark</a></li>
                        <li class="breadcrumb-item active">Edit Landmark</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Landmark</h3>

                        <a href="area.php" class="btn  float-right btn-sm bg-orange">BACK</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="code.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        if (isset($_GET['landmarkid'])) {
                                            $lid = $_GET['landmarkid'];
                                            $sql = "select * from landmark where landmark_id= '$lid' ";
                                            $result = mysqli_query($con, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                foreach ($result as $row) {
                                                    $aid = $row['area_id'];
                                        ?>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="landmarkid" value="<?php echo $lid; ?>" />

                                                        <label>Landmark Name </label>
                                                        <input type="text" class="form-control" name="landmarkname" value="<?php echo $row['landmark_name']; ?>" />

                                                        <!-- <label>Old Area Name</label> -->
                                                        <!-- <?php
                                                                $sql = "select * from area where area_id =$aid ";
                                                                $query = mysqli_query($con, $sql);
                                                                while ($row = mysqli_fetch_assoc($query)) {

                                                                ?>
                                                            <input type="text" class="form-control" name="aname" value="<?php echo $row['area_name']; ?>" />

                                                        <?php
                                                                }
                                                        ?> -->

                                                        <br />
                                                        <label>Change area</label>
                                                        <select name='areaname'>
                                                            <option>----------SELECT AREA--------</option>
                                                            <?php
                                                            $sql = "select * from area";
                                                            $query = mysqli_query($con, $sql);
                                                            while ($row = mysqli_fetch_assoc($query)) {

                                                                $select = ($row['area_id'] == $aid) ? "selected" : "";
                                                            ?>
                                                                <option <?php echo $select; ?>> <?php echo $row['area_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>


                                                    </div>

                                        <?php
                                                }
                                            } else {
                                                echo "no record found";
                                            }
                                        }
                                        ?>


                                        <div class="modal-footer">

                                            <button type="submit" class="btn bg-success" class="form-control" name="btnLandmarkUpdate">UPDATE</button>
                                        </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>

</div><?php
        include('includes/script.php');
        ?>
<?php
include('includes/footer.php');
?>