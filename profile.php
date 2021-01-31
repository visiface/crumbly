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

          <div class="profile-container">
            <div class="profile rounded">

              <div class="avatar">
                <img src="img/avatars/<?= ( $obj->avatar ?? 'placeholder.jpg' ); ?>">
              </div>

              <div class="username font-mont">
                <?= $obj->usersUsername; ?>
              </div>
              
              <div class="email font-sans">
                ID: <?= $obj->usersID; ?>
                <?= $obj->usersEmail; ?>
              </div>
            </div>

            <!-- Only shown if user is viewing their own page -->
            <?php if( isset($_SESSION["usersID"]) && $_SESSION["usersID"] == $obj->usersID ){ ?>
            
              <div class="profile-info rounded">
                <h2 class="profile-title font-mont">Edit profile</h2>
                <form action="includes/edit.inc.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="avatar">
                  <input type="email" name="email" placeholder="email">
                  <input type="password" name="password" placeholder="password">
                  <input type="password" name="passwordRepeat" placeholder="repeat password">
                  <button type="submit" name="submit">Save</button>
                </form>
              </div>

            <?php } ?>
            
          </div>

          <h2 class="profile-title font-mont">User comments</h2>
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

                    <div class="profile-container">
                      <div class="comment-container rounded">

                        <!-- remove comments but ONLY from your own page -->
                        <?php if( isset($_SESSION["usersID"]) && $_SESSION["usersID"] == $obj->usersID ){ ?>
                          <form action="includes/comment.inc.php" method="post" class="remove-comment">
                            <input type="hidden" name="form" value="remove_comment">
                            <input type="hidden" name="comment_ID" value="<?= $comment->ID; ?>">
                            <button type="submit" name="submit">Remove Comment</button>
                          </form>
                        <?php } ?>

                        <div class="comment <?= ( $comment->usersID == $obj->usersID ? 'current-user' : '' ); ?>" id="<?= $comment->ID; ?>">
                          
                          <div class="nav-left">
                            <div class="username font-mont">
                              <h4>
                                From: <a href="<?= "{$_SERVER['REQUEST_URI']}?user_ID={$comment->usersID}" ?>"><?= $comment->usersUsername; ?></a>
                              </h4>
                            </div>

                            <div class="spacer"></div>

                            <div class="comment-date font-sans">
                              Posted: <?= $comment->date; ?>
                            </div>
                          </div>


                          <div class="user-comment font-sans">
                            <?= $comment->comment; ?>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php
                }
              } else {
                echo "<h3>No comments</h3>";
              }
            }
          ?>

          <!-- must be logged in to add a comment -->
            <?php if( isset($_SESSION["usersID"]) ){ ?>
            
              <div class="profile-info rounded">
                <h4 class="profile-title font-mont">Add a Comment</h4>
                <form action="includes/comment.inc.php" method="post">
                  <input type="hidden" name="form" value="add_comment">
                  <input type="hidden" name="usersProfileID" value="<?= $obj->usersID; ?>">
                  <textarea name="comment" rows="4" cols="50"></textarea>
                  <button type="submit" name="submit">add comment</button>
                </form>
              </div>

            <?php } ?>

        <?php
      }
    } else {
      echo "The user with ID: $user_ID, does not exist";
    }
  }
  

?>
  
<?php include_once("footer.php"); ?>