<?php include_once("header.php"); ?>

<?php

  global $conn;
  
  $user_ID = ( isset($_GET['user_ID']) 
    ? $_GET['user_ID'] 
    : ( isset($_SESSION["usersID"])
      ? $_SESSION["usersID"] 
      : FALSE
    )
  );
  
  $sql = "SELECT * FROM users WHERE usersID = $user_ID";

  // Perform query
  if ($result = mysqli_query($conn, $sql)) {
    if( $result->num_rows > 0 ){
      while($obj = $result->fetch_object()){ 
        ?>

          <div class="profile">

            <div class="avatar">
              <img src="img/avatars/<?= ( $obj->avatar ?? 'placeholder.jpg' ); ?>">
            </div>

            <div class="username">
              <?= $obj->usersUsername; ?> (ID: <?= $obj->usersID; ?>)
            </div>
            <div class="email">
              <?= $obj->usersEmail; ?>
            </div>
          </div>

          <!-- Only shown if user is viewing their own page -->
          <?php if( isset($_SESSION["usersID"]) && $_SESSION["usersID"] == $obj->usersID ){ ?>
            <h2>Edit profile</h2>
            <form action="includes/edit.inc.php" method="post" enctype="multipart/form-data">
              <input type="file" name="avatar">
              <input type="email" name="email" placeholder="email">
              <input type="password" name="password" placeholder="password">
              <input type="password" name="passwordRepeat" placeholder="repeat password">
              <button type="submit" name="submit">Save</button>
            </form>

          <?php } ?>


          <!-- User comments -->
          <?php
            $sql = "SELECT 
                comments.ID,
                comments.usersID,
                users.usersUsername,
                comments.comment,
                comments.date
              FROM 
                comments 
              INNER JOIN
                users
              ON 
                comments.usersID = users.usersID
              WHERE 
                usersProfileID = {$obj->usersID}";

            if ($result = mysqli_query($conn, $sql)) {
              if( $result->num_rows > 0 ){
                while($comment = $result->fetch_object()){ 
                  ?>

                    <div class="comment <?= ( $comment->usersID == $obj->usersID ? 'current-user' : '' ); ?>" id="<?= $comment->ID; ?>">
                      <div class="username">
                        <?= $comment->usersUsername; ?>
                      </div>
                      <div class="comment-date">
                        <?= $comment->date; ?>
                      </div>
                      <div class="user-comment">
                        <?= $comment->comment; ?>
                      </div>
                    </div>

                  <?php
                }
              }
            }
          ?>

        <?php
      }
    } else {
      echo "The user with ID: $user_ID, does not exist";
    }
  }
  

?>
  
<?php include_once("footer.php"); ?>