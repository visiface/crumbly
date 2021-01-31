<?php 
  if( isset($_GET["error"]) ){

    switch ($_GET["error"]) {
      case "emptyinput":
        echo "Please fill in all fields.";
        break;
      
      case "invalidUID":
        echo "Invalid username. Please enter a valid username.";
        break;
      
      case "invalidEmail":
        echo "Invalid email. Please enter a valid email.";
        break;
      
      case "invalidPassword":
        echo "Passwords do not match. Please try again. Remember: case sensitive and special characters need to match!";
        break;
      
      case "usernameTaken":
        echo "This username is taken. Please enter another username!";
        break;
      
      case "wronglogin":
        echo "This username or email does not match our database. Double-check your case sensitive and special characters.";
        break;
      
      case "wrongloginpassword":
        echo "This password does not match our database. Double-check your case sensitive and special characters.";
        break;
      
      case "none":
        echo "Sign-Up Successful! Feel free to login.";
        break;
    }

  }
?>