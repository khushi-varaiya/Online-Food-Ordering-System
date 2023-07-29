<div class="modal fade" id="update_maincat<?php echo $row['main_cat_assign_id']?>" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <form method="POST" action="operation_hotel.php">
            <div class="modal-header">
                <h3 class="modal-title">UPDATE MAIN CATEGORY</h3>
</div>
<div class="modal-body">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="form-group">
    <label>SELECT MAIN CATEGORY :- </label>
    <input type="hidden" name="main_cat_id" value="<?php echo $row['main_cat_assign_id']?>"/>
    <select name="main_cat" class="form-control select2" style="width: 100%;">
                    <option value = "">-------------------SELECT MAIN CATEGORY-------------------</option>
                    <?php
                    while($r = mysqli_fetch_array($result))
                    {
                    ?>
                    <option value="<?php echo $r['main_cat_id'];?>"><?php echo $r['main_cat_name'];?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="main_cat_assign" class="btn btn-primary swalDefaultSuccess">SUBMIT</button>
      </div>
</form>
</div>
</div>
</div>