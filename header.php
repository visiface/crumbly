<?php 
  session_start();
  global $page_title; 

  if ( isset($_GET["logout"]) && $_GET["logout"] === 'true' ) {
    unset($_SESSION["usersID"]);
    unset($_SESSION["usersUsername"]);
    
    header("location: ./index.php");
  }
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crumbly: <?= $page_title ?? "For Bakers of All Ages"; ?></title>
  <!-- CSS + Fonts -->
   <link rel="stylesheet" href="css/style.css">
  <!-- Scripts -->
</head>
<body>
  <a name="top"></a>

  <?php
    $links = array(
      'index' => 'Home',
      'recipes' => 'Recipes',
      'signup' => 'Sign Up',
      'login' => 'Login',
    );
  ?>

  <!-- START navigation -->
    <nav>
      <div class="nav-container container">
        
          <div class="nav-left">
            <div class="logo">
              <a href="index.php"><img src="img/cookieEmote.png" alt=""></a>
            </div>
            <div class="logo-font">
              <a href="index.php"><img src="img/crumblySolid.png" alt=""></a>
            </div>
          </div>

          <div class="spacer"></div>

          <div class="main-nav">
            <div class="nav-left">  
            
              <?php if( isset($_SESSION["usersUsername"]) ){ ?>
                <div class="username">
                  <a href="profile.php">
                    <?= $_SESSION["usersUsername"]; ?>
                  </a>
                </div>
              <?php } ?>

              <ul class="no-bullets">
                <?php foreach($links as $link_key => $link_value){ 
                  if( isset($_SESSION["usersID"]) && ( $link_key === 'signup' || $link_key === 'login' ) ){ 
                    // do nothing
                  } else { ?>
                    <li>
                      <a href="<?= $link_key; ?>.php">
                        <?= $link_value; ?>
                      </a>
                    </li>
                  <?php } ?>
                <?php } ?>

                <?php if( isset($_SESSION["usersID"]) ){ ?>
                  <li>
                    <a href="index.php?logout=true" onclick="">
                      Logout
                    </a>
                  </li>
                <?php } ?>
              </ul>

            </div>
          </div>
          
      </div>
    </nav>

      

    <div class="container">
  <!-- END navigation -->