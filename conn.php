<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'fast_food';
$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
    echo "Connection not Estabilshed";
}
?>