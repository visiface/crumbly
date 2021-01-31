<?php

if (isset($_POST["submit"])) {

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (updateUser($_POST) !== false) {
    header("location: ../profile.php?update=success");
  } else {
    header("location: ../profile.php?update=fail");
  }
  exit();

}
 else {
  header("location: ../signup.php");
  exit();
}

