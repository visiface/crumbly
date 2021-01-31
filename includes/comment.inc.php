<?php

if (isset($_POST["submit"])) {

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  switch($_POST["form"]){
    case 'add_comment':
      if (addComment($_POST) !== false) {
        header("location: ../profile.php?user_ID={$_POST['usersProfileID']}&comment=success");
      }
      break;
  
    case 'remove_comment':
      if (removeComment($_POST) !== false) {
        header("location: ../profile.php?user_ID={$_SESSION["usersID"]}&comment=success");
      }
      break;
    
  }
  exit();

}
 else {
  header("location: ../signup.php");
  exit();
}

