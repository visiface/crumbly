<?php

 if (emptyInputSignup($username, $email, $password, $passwordRepeat) !==false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }

function emptyInputSignup($username, $email, $password, $passwordRepeat) {

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;

}


function invalidUID($username) {
 
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}


function invalidEmail($email) {

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;

}


function passwordMatch($password, $passwordRepeat) {

  if ($password !== $passwordRepeat) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;

}


function usernameTaken($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($statement, "ss", $username, $email);
  mysqli_stmt_execute($statement);

  $resultData = mysqli_stmt_get_result($statement);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
   $result = false;
   return $result;
  }
  mysqli_stmt_close($statement);
}


function createUser($conn, $username, $email, $password) {
  $sql = "INSERT INTO users (usersUsername, usersEmail, usersPassword) VALUES (?, ?, ?);";
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  $hashedPassword = $password; //password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
  mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);
  header("location: ../signup.php?error=none");
    exit();

}