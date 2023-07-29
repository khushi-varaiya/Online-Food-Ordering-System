<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-secondary sidebar-dark-primary elevation-4 "  >
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 pl-0 d-flex">
        <div class="image">
          <?php
          include('conn.php');
          $query = "SELECT image from hotel where hotel_name = '" . $_SESSION['username'] . "'";
          $result = mysqli_query($conn, $query);
          $res = mysqli_query($conn, $query);
          $rows = mysqli_num_rows($result);
          $row = mysqli_fetch_array($res);
          if($rows == 1)
          {
           $_SESSION['image'] = $row['image'];
          }
          ?>
          <img src=" <?php echo $_SESSION['image'];?>" class="img-circle elevation-2" alt="User Image" style="width: 70px; height: 70px;">
        </div>
        <div class="info">
          <div class="d-block" style="color:white; font-size:20px;"><?php echo $_SESSION['username'];?></div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>