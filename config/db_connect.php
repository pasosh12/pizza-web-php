<?php
 
 
$servername = "localhost";
$username = "root";
$password = "1";
$dbname = "pizza_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}
// else{
//     echo "connect success";
// }

// mysqli_close($conn);
?>