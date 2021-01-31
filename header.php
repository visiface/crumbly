<?php global $page_title; ?>
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

              <ul class="no-bullets">
                <?php foreach($links as $link_key => $link_value){ ?>
                  <li>
                    <a href="<?= $link_key; ?>.php">
                      <?= $link_value; ?>
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