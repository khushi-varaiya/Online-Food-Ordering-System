<?php

include('DataBaseConfig/DataConnection.php');
session_start();




//===================================================================================================
// ***************************************AREA **********************************************************
// Insert operation on  Area-------------------------------------------------------------------

if (isset($_POST['btnAddArea'])) {


    //  for getting last id of table
    $res = mysqli_query($con, "SELECT MAX(area_id) as aid FROM area ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['aid'];

    // all data --
    $aid = $lastid + 1;
    $aname = $_POST['area_name'];
    $pincode = $_POST['area_pincode'];
    //-- Insert Operation
    $sql = "insert into area values('$aid', '$aname','$pincode')";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:area.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:area.php");
    }
}

// Update operation on  Area-------------------------------------------------------------------
if (isset($_POST['btnAreaUpdate'])) {

    $aid = $_POST['areid'];
    $aname = $_POST['area_name'];
    $pincode = $_POST['area_pincode'];

    $sql = "UPDATE `area` SET `area_name`='$aname',`pincode`='$pincode' WHERE area_id='$aid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:area.php");
    } else {
        $_SESSION['status'] = "Not Updated";
        header("location:area.php");
    }
}
//--------------------Delete on area -----------------------------------------------------
if (isset($_POST['area_delete'])) {

    $aid = $_POST['area_id'];
    $sql = "Delete from area where area_id = '$aid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:area.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:area.php");
    }
}



//========================================================================================================
// ***************************************User **********************************************************
// Insert operation on  User-------------------------------------------------------------------

if (isset($_POST['btnAddUser'])) {


    $mno = $_POST['mno'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $gender = $_POST['gender'];
    $type = "USER";

    echo "hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh";
    $sql = "INSERT INTO `user`(`mobile_no`, `fname`, `lname`, `email`, `password`, `gender`, `type`) VALUES ('$mno','$fname','$lname','$email','$password','$gender','$type')";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:customer.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:customer.php");
    }
}


// Update operation on  User-------------------------------------------------------------------
if (isset($_POST['btnUserUpdate'])) {

    $oldmno = $_POST['oldmno'];
    $mno = $_POST['mno'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $gender = $_POST['gender'];

    $sql = "UPDATE `user` SET `mobile_no`='$mno',`fname`='$fname',`lname`='$lname',`email`='$email',`password`='$pass',`gender`='$gender' WHERE mobile_no ='$oldmno' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:customer.php");
    } else {
        $_SESSION['status'] = "Not Updated";
        header("location:customer.php");
    }
}
//-----------------------------------------------------------------------------------------------

//=================================================================================================================

// ***************************************Main Category **********************************************************
// Insert operation on  Main Category-------------------------------------------------------------------
if (isset($_POST['btnAddMainCat'])) {



    // for getting last id of table
    $res = mysqli_query($con, "SELECT MAX(main_cat_id) as mid FROM main_category ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['mid'];

    $mid = $lastid + 1;
    $mname = $_POST['mname'];

    $sql = "insert into  main_category values('$mid', '$mname')";
    $res = mysqli_query($con, $sql);
    if ($res > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:maincat.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:maincat.php");
    }
}


// Update operation on  Main Category-------------------------------------------------------------------
if (isset($_POST['btnMainCatUpdate'])) {
    $mid = $_POST['mid'];
    $mname = $_POST['mname'];
    $sql = "update main_category set main_cat_name='$mname' where main_cat_id = '$mid' ";

    $res =  mysqli_query($con, $sql);
    if ($res > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:maincat.php");
    } else {
        $_SESSION['status'] = "Not updated";
        header("location:maincat.php");
    }
}

//--------------------Delete on main category -----------------------------------------------------
if (isset($_POST['main_cat_delete'])) {

    $lid = $_POST['main_cat_id'];
    $sql = "Delete from main_category where main_cat_id = '$lid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:maincat.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:maincat.php");
    }
}



//--------------------------------------------------------------------------------------------------------
//===========================================================================================================


//==========================================================================================================
// ***************************************Sub Category **********************************************************
// Insert operation on  Sub Category-------------------------------------------------------------------

if (isset($_POST['btnAddSubCat'])) {
    $sname = $_POST["sname"];
    $mname = $_POST['mname'];

    $query = "select main_cat_id from main_category where main_cat_name='$mname'";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_array($res)) {
            $mid = $row['main_cat_id'];
        }
    }

    $res = mysqli_query($con, "SELECT MAX(sub_cat_id) as sid FROM sub_category ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['sid'];
    $sid = $lastid + 1;



    $sql1 = "INSERT INTO `sub_category`(`sub_cat_id`, `main_cat_id`, `sub_cat_name`) VALUES ('$sid','$mid','$sname')";
    $res = mysqli_query($con, $sql1);
    if ($res > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:subcat.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:subcat.php");
    }
}
// Update operation on  Sub Category-------------------------------------------------------------------
if (isset($_POST['btnSubCatUpdate'])) {
    $sid = $_POST['subcatid'];
    $sname = $_POST['subcatname'];
    $mname = $_POST['maincatname'];
    $mid = "";
    $sql = "select * from main_category where main_cat_name = '$mname'";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $mid = $row['main_cat_id'];
    }

    $sqls = "UPDATE `sub_category` SET `main_cat_id`='$mid',`sub_cat_name`='$sname' WHERE sub_cat_id='$sid'";
    $querys = mysqli_query($con, $sqls);
    if ($querys > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:subcat.php");
    } else {
        $_SESSION['status'] = "Not updated";
        header("location:subcat.php");
    }
}


//--------------------Delete on sub category -----------------------------------------------------
if (isset($_POST['sub_cat_delete'])) {

    $lid = $_POST['sub_cat_id'];
    $sql = "Delete from sub_category where sub_cat_id = '$lid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:subcat.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:subcat.php");
    }
}
//================================================================================================================
// ***************************************Petasub Category **********************************************************
// Insert operation on  Petasub Category-------------------------------------------------------------------
if (isset($_POST['btnAddpetaSubCat'])) {
    $pname = $_POST["pname"];
    $sname = $_POST['sname'];

    $query = "select sub_cat_id from sub_category where sub_cat_name='$sname'";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_array($res)) {
            $sid = $row['sub_cat_id'];
        }
    }

    $res = mysqli_query($con, "SELECT MAX(petasub_cat_id) as pid FROM petasub_category ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['pid'];
    $pid = $lastid + 1;



    $sql1 = "INSERT INTO `petasub_category`(`petasub_cat_id`, `sub_cat_id`, `petasub_cat_name`) VALUES ('$pid','$sid','$pname')";
    $res = mysqli_query($con, $sql1);
    if ($res > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:peta_subcat.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:peta_subcat.php");
    }
}

// Update operation on  PetaSub Category-------------------------------------------------------------------
if (isset($_POST['btnpetaSubCatUpdate'])) {
    echo "hgjhhhhhhhhhhhhhhhh";
    $pid = $_POST['petasubcatid'];
    $pname = $_POST['petasubcatname'];
    $sname = $_POST['subcatname'];
    $sid = "";
    $sql = "select * from sub_category where sub_cat_name = '$sname'";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $sid = $row['sub_cat_id'];
    }

    $sqls = "UPDATE `petasub_category` SET `sub_cat_id`='$sid',`petasub_cat_name`='$pname' WHERE petasub_cat_id='$pid'";
    $querys = mysqli_query($con, $sqls);
    if ($querys > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:peta_subcat.php");
    } else {
        $_SESSION['status'] = "Not updated";
        header("location:peta_subcat.php");
    }
}

//--------------------Delete on petasub category -----------------------------------------------------
if (isset($_POST['petasub_cat_delete'])) {

    $lid = $_POST['petasub_cat_id'];
    $sql = "Delete from petasub_category where petasub_cat_id = '$lid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:peta_subcat.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:peta_subcat.php");
    }
}

//================================================================================================================
// ***************************************Package ********************************************************
// Insert operation on  Petasub Category-------------------------------------------------------------------
if (isset($_POST['btnAddPackage'])) {
    $packname = $_POST['packname'];
    $duration = $_POST['duration'];
    $rate = $_POST['rate'];

    $res = mysqli_query($con, "SELECT MAX(package_id) as pid FROM package ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['pid'];
    $packid = $lastid + 1;

    $sql = "insert into package values('$packid', '$packname','$duration', '$rate')";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:pack.php");
    } else {
        $_SESSION['status'] = "Not Inserted";
        header("location:pack.php");
    }
}
// --------------------------package update--------------------
if (isset($_POST['btnPackageUpdate'])) {
    $packid = $_POST['packid'];
    $packname = $_POST['packname'];
    $duration = $_POST['duration'];
    $rate = $_POST['rate'];

    $sql = "UPDATE `package` SET `package_name`='$packname',`duration`='$duration',`rate`='$rate' WHERE package_id=$packid";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:pack.php");
    } else {
        $_SESSION['status'] = "Not Updated";
        header("location:pack.php");
    }
}


//--------------------Delete on package -----------------------------------------------------
if (isset($_POST['package_delete'])) {

    $pid = $_POST['package_id'];
    $sql = "Delete from package where package_id = '$pid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:pack.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:pack.php");
    }
}


// =============================================================================================
//================================================================================================================
// ***************************************Landmark********************************************************
// Insert operation on  Landmark-------------------------------------------------------------------
if (isset($_POST['btnAddLandmark'])) {
    $lname = $_POST["landmarkname"];
    $aname = $_POST['areaname'];

    $query = "select area_id from area where area_name='$aname'";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res) == 1) {
        while ($row = mysqli_fetch_array($res)) {
            $aid = $row['area_id'];
        }
    }

    $res = mysqli_query($con, "SELECT MAX(landmark_id) as lid FROM landmark");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['lid'];
    $lid = $lastid + 1;



    $sql1 = "INSERT INTO `landmark`(`landmark_id`, `area_id`, `landmark_name`) VALUES ('$lid','$aid','$lname')";
    $res = mysqli_query($con, $sql1);
    if ($res > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:landmark.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:landmark.php");
    }
}
// update operation on  Landmark-------------------------------------------------------------------
if (isset($_POST['btnLandmarkUpdate'])) {

    $landmarkid = $_POST['landmarkid'];
    $lname = $_POST['landmarkname'];
    $aname = $_POST['areaname'];
    $aid = "";
    $sql = "select * from area where area_name = '$aname'";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $aid = $row['area_id'];
    }

    $sqls = "UPDATE `landmark` SET `area_id`='$aid',`landmark_name`='$lname' WHERE `landmark_id`='$landmarkid'";
    $querys = mysqli_query($con, $sqls);
    if ($querys > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:landmark.php");
    } else {
        $_SESSION['status'] = "Not updated";
        header("location:landmark.php");
    }
}

//--------------------Delete on landmark -----------------------------------------------------
if (isset($_POST['landmark_delete'])) {

    $lid = $_POST['landmark_id'];
    $sql = "Delete from landmark where landmark_id = '$lid' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:landmark.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:landmark.php");
    }
}



//===================================================================================================
// ***************************************Discount **********************************************************
// Insert operation on  Area-------------------------------------------------------------------

if (isset($_POST['btnAddDiscount'])) {


    //  for getting last id of table
    $res = mysqli_query($con, "SELECT MAX(discount_id) as did FROM discount ");
    $rowid = mysqli_fetch_array($res);
    $lastid = $rowid['did'];

    // all data --
    $did = $lastid + 1;
    $dname = $_POST['coupan_code'];
    $percent = $_POST['discount_percentage'];
    //-- Insert Operation
    $sql = "insert into discount values('$did', '$dname','$percent')";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Inserted.";
        header("location:discount.php");
    } else {
        $_SESSION['status'] = "Not inserted";
        header("location:discount.php");
    }
}

// Update operation on  discount-------------------------------------------------------------------
if (isset($_POST['btnDiscountUpdate'])) {

    $did = $_POST['did'];
    $dname = $_POST['coupan_code'];
    $percent = $_POST['percentage'];

    $sql = "UPDATE `discount` SET `discount_name`='$dname',`percentage`='$percent' WHERE discount_id='$did' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Updated.";
        header("location:discount.php");
    } else {
        $_SESSION['status'] = "Not Updated";
        header("location:discount.php");
    }
}
//--------------------Delete on discount -----------------------------------------------------
if (isset($_POST['discount_delete'])) {

    $did = $_POST['discount_id'];
    $sql = "Delete from discount where discount_id = '$did' ";
    $query = mysqli_query($con, $sql);

    if ($query > 0) {
        $_SESSION['status'] = "Successfully Deleted.";
        header("location:discount.php");
    } else {
        $_SESSION['status'] = "Not Deleted";
        header("location:discount.php");
    }
}



//========================================================================================================
