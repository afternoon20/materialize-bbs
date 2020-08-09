<?php
  require_once('config.php');
  
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <title>エラー | afternoon_bbs</title>
  </head>
  <body>    
    <?php if($_SESSION['error']===''){
        header('Location: index.php');
      };
    ?>

    <div class="container container--error">
      <div class="error-txt">
        <a href="index.php" class="header-ttl brand-logo teal-text lighten-3"><?php echo TITLE ?></a>
        <p>不正なリクエストがありました。[<?php echo $_SESSION['error'] ?>]<br>お手数ですが、再度もう一度お試し下さい。</p> 
      </div>
    </div>
    
    <?php $_SESSION['error'] = '' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>