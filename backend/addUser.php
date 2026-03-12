<?php 
include("database.php");
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  
  $checkIfAccExistQuery = "SELECT fullname, email FROM tbl_users WHERE fullname = '$fullName' OR email = '$email' LIMIT 1";
  $result = $conn -> query($checkIfAccExistQuery);

  if($result->num_rows>0){
    $_SESSION['error'] = "Account already Exist";
  }
  else{
    $addUserQuery = "INSERT INTO tbl_users (fullname, email, role) VALUES ('$fullName', '$email', '$role')";

    if($conn -> query($addUserQuery)){
      $_SESSION['success'] = "User successfully added";
    }
    else{
      $_SESSION['error'] = "Database Error: " . $conn->error;
    }
  }

header("Location: ../pages/dashboard.php");
exit();


?>