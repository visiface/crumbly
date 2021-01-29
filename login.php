<?php 
  global $page_title;
  $page_title = "Login";
  
  include_once("header.php");
?>


  <section>
    <h2>Login</h2>
    <form action="includes/login.inc.php" method="post">
      <input type="text" name="uid" placeholder="email or username">
      <input type="password" name="pwd" placeholder="password">
      <button type="submit" name="submit">Login</button>
    </form>
  </section>

  <!-- TBA error messages -->

<?php include_once("footer.php"); ?>