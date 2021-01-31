<?php
session_start();

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

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
  mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);
  header("location: ../signup.php?error=none");
    exit();

}


function removeComment($data) {
  global $conn;

  if( isset($_SESSION["usersID"]) === FALSE ){
    header("location: ../profile.php?error=notLoggedIn");
    exit();
  }    

  $sql = sprintf(
    "DELETE FROM 
      comments 
    WHERE 
      ID = %d
    AND
      usersID = %d",
    $data['comment_ID'],
    $_SESSION["usersID"]
  );
      
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../profile.php?error=stmtFailed");
    exit();
  }

  $result = mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);

  return $result;

}


function addComment($data) {
  global $conn;

  if( isset($_SESSION["usersID"]) === FALSE ){
    header("location: ../profile.php?error=notLoggedIn");
    exit();
  }    

  $sql = "INSERT INTO 
      comments (comment, usersID, usersProfileID)
    VALUES
      ('{$data['comment']}', {$_SESSION["usersID"]}, {$data['usersProfileID']})";
      
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../profile.php?error=stmtFailed");
    exit();
  }

  // mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
  $result = mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);

  return $result;

}

function updateUser($data) {
  global $conn;

  if( isset($_SESSION["usersID"]) === FALSE ){
    header("location: ../profile.php?error=notLoggedIn");
    exit();
  }    

  if( passwordMatch($data["password"], $data["passwordRepeat"]) === TRUE ){
    header("location: ../profile.php?error=notSamePassword");
    exit();
  }    

  // Store all fields in an array that we're gonna push to the DB
  $fields = array();
  if( isset($data["email"]) && !empty($data["email"]) ){
    array_push($fields, "usersEmail = '{$data["email"]}'");
  }
  if( isset($data["password"]) && !empty($data["password"]) ){
    $hashedPassword = password_hash($data["password"], PASSWORD_DEFAULT);
    array_push($fields, "usersPassword = '$hashedPassword'");
  }
  if( isset($_FILES["avatar"]) && !empty($_FILES["avatar"]) ){

    // With pathinfo() we can get a file's extension (.png, .jpg, .svg, etc...)
    // pathinfo() return an array so we just call ['extension'] right after as we only care about the extension 
    $filetype = pathinfo($_FILES["avatar"]["name"])['extension'];
    
    // microtime() gets the current time as one long number
    // md5() encrypts a value
    // substr() shortens a string (in this case by 10)
    $new_file = substr(md5(microtime()), 1, 10) . ".$filetype";

    move_uploaded_file(
      $_FILES["avatar"]["tmp_name"], 
      "../img/avatars/$new_file"
    );

    array_push($fields, "avatar = '{$new_file}'");
  }

  // Combindes all fields into a string, where every field is seperated by comma (except for the last field)
  $fields = implode(', ', $fields);

  $sql = "UPDATE 
      users
    SET 
      $fields
    WHERE 
      usersID = {$_SESSION["usersID"]};"; // $_SESSION["usersID"] makes sure we ONLY edit the current logged in users info  
      
  $statement = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location: ../profile.php?error=stmtFailed");
    exit();
  }

  // mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
  $result = mysqli_stmt_execute($statement);
  mysqli_stmt_close($statement);

  return $result;

}

function emptyInputLogin($username, $password) {

  $result = false;
  if ( empty($username) || empty($password) ) {
    $result = true;
  }
  
  return $result;
}

function loginUser($conn, $username, $password) {
  $usernameExists = usernameTaken($conn, $username, $username);

  if ($usernameExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $passwordHashed = $usernameExists["usersPassword"];
  $checkPassword = password_verify($password, $passwordHashed);

  if ($checkPassword === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  } 
  else if ($checkPassword === true) {
    $_SESSION["usersID"] =  $usernameExists["usersID"];
    $_SESSION["usersUsername"] =  $usernameExists["usersUsername"];
    header("location: ../index.php");
    exit();
  }
}