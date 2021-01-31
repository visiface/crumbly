<?php 
  global $page_title;
  $page_title = "Login";
  
  include_once("header.php");
?>


  <section>
    <h2>Login</h2>
    <form action="includes/login.inc.php" method="post">
      <input type="text" name="username" placeholder="email or username">
      <input type="password" name="password" placeholder="password">
      <button type="submit" name="submit">Login</button>
    </form>

    <?php include_once("includes/errors.php"); ?>
  </section>

<?php include_once("footer.php"); ?>