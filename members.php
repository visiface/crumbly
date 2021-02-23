<?php 
  global $page_title;
  $page_title = "Bakers: Member Directory";

  include_once("header.php");
?>

<br>
<div class="font-mont">
  <h2>Meet Your Fellow Bakers</h2>
</div>

<?php

  global $conn;
  
  $user_ID = ( isset($_GET['user_ID']) 
    ? $_GET['user_ID'] 
    : ( isset($_SESSION["usersID"])
      ? $_SESSION["usersID"] 
      : FALSE
    )
  );
  
  $sql = "SELECT * FROM users";


  // Perform query
  if ($result = mysqli_query($conn, $sql)) {
    if( $result->num_rows > 0 ){
      while($obj = $result->fetch_object()){?> 
        <br>
        <div class="profile-info rounded font-sans">
          <h4 class="profile-title font-mont no-txt-decor">
            <a href="profile.php?user_ID=<?= $obj->usersID ?>">
              <?= $obj->usersUsername; ?>
            </a>
          </h4>
          this is where a bio and information would go if i had set up tables and columns for that: especially using the knowledge i know now compared to when i started this assignment. i will rebuild crumbly. i have the technology. 
        </div>
        <?php
        }
      }
    }?>
  
<?php include_once("footer.php"); ?>