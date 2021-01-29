<?php

if (isset($_POST["submit"])) {
  
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($username, $email, $password, $passwordRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  if (invalidUID($username) !== false) {
  header("location: ../signup.php?error=invalidUID");
  exit();
  }
  if (invalidEmail($email) !== false) {
  header("location: ../signup.php?error=invalidEmail");
  exit();
  }
  if (passwordMatch($password, $passwordRepeat) !== false) {
  header("location: ../signup.php?error=invalidPassword");
  exit();
  }
  if (usernameTaken($conn, $username, $email) !== false) {
  header("location: ../signup.php?error=usernameTaken");
  exit();
  }

  createUser($conn, $username, $email, $password);

}
 else {
  header("location: ../signup.php");
  exit();
}

