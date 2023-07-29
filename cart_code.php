<!-- coed for add cart in add to cart table -->
<?php
include('db.php');
if (isset($_POST['add_to_cart'])) {

    session_start();
    $mn =  (isset($_SESSION['mobile_no']) ? $_SESSION['mobile_no'] : "");


    $item_id = $_POST['item_id'];


    $sqlFetchCart = "SELECT * FROM `add_to_cart` WHERE item_id = $item_id AND mobile_no = '$mn'";

    $queryFetchCart = mysqli_query($conn, $sqlFetchCart);

    $rowFetchCart = mysqli_fetch_row($queryFetchCart);

    if ($rowFetchCart > 0) {

        $sql = "delete from add_to_cart where  item_id = $item_id AND mobile_no = '$mn'";
        $queryDeleteCart = mysqli_query($conn, $sql);
    } else {

        $sqlAddCart = "INSERT INTO `add_to_cart`( `item_id`, `qty`, `mobile_no`) VALUES ('$item_id','1','$mn')";
        $queryAddCart = mysqli_query($conn, $sqlAddCart);
    }
}
?>