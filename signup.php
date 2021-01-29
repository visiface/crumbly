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

  <!-- TBA error messages -->


<?php include_once("footer.php"); ?>