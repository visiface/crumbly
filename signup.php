<?php 
  global $page_title;
  $page_title = "Sign up";

  include_once("header.php");
?>


  <section>

    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="username" placeholder="username">
      <input type="email" name="email" placeholder="email">
      <input type="password" name="password" placeholder="password">
      <input type="password" name="passwordRepeat" placeholder="repeat password">
      <button type="submit" name="submit">Sign Up</button>
    </form>
  </section>

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
      case "none":
        echo "Sign-Up Successful! Feel free to login.";
        break;
    }

  }
?>


<?php include_once("footer.php"); ?>