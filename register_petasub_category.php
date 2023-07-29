<?php
include('conn.php');
session_start();

?>
<html>
<head>
</head>
<body>
<form action = "operation_petasub_cat.php" method = "post">
      <div class="modal-body">
       <div class = "form-group">
       <label>SELECT SUB CATEGORY :- </label>
                  <?php
                  $sql="select * from sub_category";
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
                  </br>
                  </br>
                  <label>SELECT PETA SUB CATEGORY :- </label>
                  <input type='text' class='input-field' placeholder='petasubname' name="petasubname">
                    </select>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="peta_cat" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
      </div>
    </form>
</body>
</html>