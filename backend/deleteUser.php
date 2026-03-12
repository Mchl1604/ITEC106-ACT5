<?php 
session_start();

include("database.php");

$id = $_POST['del_id'];
$deleteUserQuery = "DELETE FROM tbl_users WHERE id = '$id'";

if($conn -> query($deleteUserQuery)){
  $_SESSION['success'] = "User successfully deleted";
}
else{
  $_SESSION['error'] = "Database Error: " . $conn->error;
}

header("Location: ../pages/dashboard.php");
exit();
?>