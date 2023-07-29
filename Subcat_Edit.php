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
                    <h1 class="m-0 text-dark">Sub Category</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php" style="color: orange;">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php" style="color: orange;">Category</a></li>
                        <li class="breadcrumb-item"><a href="subcat.php" style="color: orange;">Sub Category</a></li>
                        <li class="breadcrumb-item active">Edit Sub Category </li>

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
                        <h3 class="card-title">Edit Sub Category</h3>

                        <a href="area.php" class="btn  float-right btn-sm bg-orange">BACK</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="code.php" method="POST">
                                    <div class="modal-body">
                                        <?php
                                        if (isset($_GET['subcatid'])) {
                                            $sid = $_GET['subcatid'];
                                            $sql = "select * from sub_category where sub_cat_id= '$sid' ";
                                            $result = mysqli_query($con, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                foreach ($result as $row) {
                                                    $mid = $row['main_cat_id'];
                                        ?>
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" name="subcatid" value="<?php echo $sid; ?>" />

                                                        <label>Sub Category </label>
                                                        <input type="text" class="form-control" name="subcatname" value="<?php echo $row['sub_cat_name']; ?>" />



                                                        <br />
                                                        <label>Change Main Category</label>
                                                        <select name='maincatname'>
                                                            <option>----------SELECT MAIN CATEGORY-------------</option>
                                                            <?php
                                                            $sql = "select * from main_category";
                                                            $query = mysqli_query($con, $sql);
                                                            while ($row = mysqli_fetch_assoc($query)) {
                                                                $select = ($row['main_cat_id'] == $mid) ? "selected" : "";
                                                            ?>
                                                                <option <?php echo $select; ?>><?php echo $row['main_cat_name']; ?></option>
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

                                            <button type="submit" class="btn bg-success" class="form-control" name="btnSubCatUpdate">UPDATE</button>
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