<?php
  require_once('config.php');
  if (!$_SESSION['user_name'] == "") {
    header("Location: index.php");
    exit();
  } 
  include ('header.php');
?>
    <div class="container">
      <a href="index.php" class="teal-text lighten-3 breadcrumbs"><span class="icon"><i class="material-icons">home</i></span>ホーム</a>
      <span>&gt;</span>
      <h2 class="center">ログイン</h2>
      <p class="center">ログインIDとパスワードを入力してログインします。</p>
      <main>
        <p class="error-message red-text">
        <?php
          if($_SESSION['error'] !== ''){
            echo $_SESSION['error'];
          };
        ?>
        <div class="form-wrapper">
          <form action="loginForm.php" method="post">
            <label>ログインID
              <input type="text" name="login_id" required maxlength = "16" />
            </label>
            <label class="password" >パスワード
              <input type="password" name="password" required maxlength="32" />
              <span class="password-toggler"><i class="material-icons left">visibility</i></span>
            </label>
            
            <div class="center form__btn">
              <input class="btn" type="submit" value="ログイン" />
            </div>
          </form>
        </div>
      </main>
    </div>
  <?php include('footer.php'); ?>
