<?php
  require_once('config.php');
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta property="og:title" content="Materialize-bbs" />
    <meta property="og:type" content="website" />
    <meta
      property="og:description"
      content="Materialize-bbsはPHPを学習するために作成した掲示板です。"
    />
    <meta property="og:url" content="<?php echo URL ?>>"/>
    <meta property="og:site_name" content="Materialize-bbs" />
    <meta property="og:image" content="https://bbs.afternoon-web.com/img/dist/materialize-bbs.png" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost:8001/css/style.css" />
    <link rel="shortcut icon" href="favicon.ico" />
    <title><?php echo TITLE ?></title>
  </head>
  <body>
    <header>
      <nav>
        <div class="nav-wrapper teal lighten-3">
          <div class="container">
            <a href="../index.php" class="header-ttl brand-logo"><?php echo TITLE ?></a>
            <!-- <a class="header-ttl" href="index.php">Afternoon-BBS</a> -->
            <ul class="right hide-on-med-and-down">
            <?php If(!isset($_SESSION['user_name'])) : ?>
              <li><a href="login.php" class="white-text waves-effect waves-light btn-flat">ログイン</a></li>
              <li><a href="register.php" class="white-text waves-effect waves-light btn-flat">登録する</a></li>
             <?php else : ?>
              <li class="header-txt" >こんにちは、<?php echo $_SESSION['user_name'] ?>さん</li>
              <li><a href="logoutForm.php" class="white-text waves-effect waves-light btn-flat">ログアウト</a></li>
              <li><a class="white-text waves-effect waves-light btn-flat modal-trigger" href="#modal">退会する</a></li>
              <!-- ポップアップ表示 -->
              <div id="modal" class="modal">
                <div class="modal-content post-modal">
                  <h3 class="modal-txt">本当に退会しますか？</h3>
                  <p class="modal-txt">一度退会すると、復元はできません。<br>掲示板の作成、編集、削除ができなくなります。</p>
                </div>
                <div class="modal-footer">
                  <form action="http://localhost:8001/withdrawForm.php" method="post">
                  <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id'] ;?>">
                  <input class="btn blue" type="submit" value="退会する" />
                </form> 
              </div>
            </div>       
            <?php endif; ?>
            </ul>
            <!-- ドロップダウンリスト -->
            <a class='dropdown-trigger right' href='#' data-target='dropdown'><i class="material-icons">apps</i></a>
            <ul id='dropdown' class='dropdown-content'>
               <?php If(!isset($_SESSION['user_name'])) : ?>
              <li><a href="login.php">ログイン</a></li>
              <li><a href="register.php">登録する</a></li>
             <?php else : ?>
               <li>
               <div class="center dropdown-txt">
                 <i class="material-icons tiny">person</i>
                 <?php echo $_SESSION['user_name'] ?>
               </div>
               </li>
               <li class="divider" tabindex="-1"></li>
               <li><a href="http://localhost:8001/logoutForm.php">ログアウト</a></li>
               <li><a class="grey-text lighten-1 modal-trigger" href="#modal-mb">退会する</a></li>
            <?php endif; ?>
            </ul>
         </div>
        </div>
      </nav>
      <!-- スマホ表示のモーダルウィンドウ -->
      <?php If(isset($_SESSION['user_name'])) : ?>
      <div id="modal-mb" class="modal">
        <div class="modal-content post-modal">
          <h3 class="modal-txt">本当に退会しますか？</h3>
          <p class="modal-txt">一度退会すると、復元はできません。<br>掲示板の作成、編集、削除ができなくなります。</p>
        </div>
        <div class="modal-footer">
          <form action="http://localhost:8001/withdrawForm.php" method="post">
            <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id'] ;?>">
            <input class="btn blue" type="submit" value="退会する" />
          </form> 
        </div>
      </div>
      <?php endif; ?>
    </header>