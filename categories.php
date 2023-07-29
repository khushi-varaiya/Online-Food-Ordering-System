<?php
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('DataBaseConfig/DataConnection.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Categories Details...</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                        <!-- <li class="breadcrumb-item active"></li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <?php
                            $sql = "SELECT count(*) as A_count FROM main_category";
                            $query = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                                $res = $row['A_count'];
                            }

                            ?>
                            <h3><?php echo $res;   ?></h3>
                            <h4>Main Category</h4>
                        </div>
                        <div class="icon">
                            <i class="	fas fa-map-marker-alt"></i>
                        </div>
                        <a href="maincat.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <?php
                            $sql = "SELECT count(*) as A_count FROM sub_category";
                            $query = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                                $res = $row['A_count'];
                            }

                            ?>
                            <h3><?php echo $res;   ?></h3>
                            <h4>Sub Category</h4>
                        </div>
                        <div class="icon">
                            <i class="	fas fa-map-marker-alt"></i>
                        </div>
                        <a href="subcat.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <?php
                            $sql = "SELECT count(*) as A_count FROM petasub_category";
                            $query = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                                $res = $row['A_count'];
                            }

                            ?>
                            <h3><?php echo $res;   ?></h3>

                            <h4>Peta-Sub Category</h4>
                        </div>
                        <div class="icon">
                            <i class="	fas fa-map-marker-alt"></i>
                        </div>
                        <a href="peta_subcat.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div><?php
        include('includes/script.php');
        ?>
<?php
include('includes/footer.php');
?>