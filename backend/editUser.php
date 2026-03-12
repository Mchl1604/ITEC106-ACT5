<?php 
include("database.php");

$id = $_POST['id'];
$fullName = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];
$status = $_POST['status'];

$checkIfAccExistQuery = "SELECT fullname, email FROM tbl_users WHERE (fullname = '$fullName' OR email = '$email') AND id != '$id' LIMIT 1";
$result = $conn -> query($checkIfAccExistQuery);

if($result->num_rows>0){
  $message = "Account already Exist";
  header("Location: ../pages/dashboard.php");
  exit();
}

$updateUserQuery = "UPDATE tbl_users SET fullname = '$fullName', email = '$email', role = '$role', status = '$status' ";

if($password != ""){
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $updateUserQuery .= ", password = '$hashedPassword' ";
}

$updateUserQuery .= "WHERE id = '$id'";

if($conn -> query($updateUserQuery)){
  $message = "User successfully updated";
}
else{
  $message = "Database Error: " . $conn->error;
}

header("Location: ../pages/dashboard.php");
exit();
?>