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
                    <h1 class="m-0 text-dark">Peta-Sub Category</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php" style="color: orange;">Category</a></li>
                        <li class="breadcrumb-item"><a href="peta_subcat.php" style="color: orange;">Peta-Sub Category</a></li>
                        <li class="breadcrumb-item active">Edit Peta-Sub Category </li>

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
                        <h3 class="card-title">Edit Peta-Sub Category</h3>

                        <a href="area.php" class="btn  float-right btn-sm bg-orange">BACK</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="code.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        if (isset($_GET['petasubcatid'])) {
                                            $pid = $_GET['petasubcatid'];
                                            $sql = "select * from petasub_category where petasub_cat_id= '$pid' ";
                                            $result = mysqli_query($con, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                foreach ($result as $row) {
                                                    $sid = $row['sub_cat_id'];
                                        ?>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="petasubcatid" value="<?php echo $pid; ?>" />

                                                        <label>Peta-Sub Category Name </label>
                                                        <input type="text" class="form-control" name="petasubcatname" value="<?php echo $row['petasub_cat_name']; ?>" />

                                                        <br />
                                                        <label>Change Sub</label>
                                                        <select name='subcatname'>
                                                            <option>----------SELECT Sub Category--------</option>
                                                            <?php
                                                            $sql = "select * from sub_category";
                                                            $query = mysqli_query($con, $sql);
                                                            while ($row = mysqli_fetch_assoc($query)) {

                                                                $select = ($row['sub_cat_id'] == $sid) ? "selected" : "";
                                                            ?>
                                                                <option <?php echo $select; ?>> <?php echo $row['sub_cat_name']; ?></option>
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

                                            <button type="submit" class="btn bg-success" class="form-control" name="btnpetaSubCatUpdate">UPDATE</button>
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