<?php 
  require_once('config.php');
  include('header.php');
?>

    <div class="container">
      <a href="index.php" class="teal-text lighten-3 breadcrumbs"><span class="icon"><i class="material-icons">home</i></span>ホーム</a>
      <span>&gt;</span>
      <h2 class="center center">登録</h2>
      <p class="center">ログインIDとパスワードを入力して登録しましょう。</p>
      <main>
        <p class="error-message red-text">
        <?php
          if($_SESSION['error'] !== ''){
            echo $_SESSION['error'];
          };
        ?>
        </p>
        <div class="form-wrapper">
          <form action="registerForm.php" method="post">
            <label>
              ログインID(半角英数字 6~16文字以内)
              <input type="text" name="login_id" required maxlength="16"　pattern="^[0-9A-Za-z]+$" title="エラー表記でっせ。" />
            </label>
            <label>
              ニックネーム(24文字以内)
              <input type="text"　maxlength="24" required name="user_name" />
            </label>
            <label class="password">
              パスワード(半角英数字 6~16文字以内)
              <input type="password" required maxlength="32" name="password" />
              <span class="password-toggler"><i class="material-icons left">visibility</i></span>
            </label>
            
            <div class="center form__btn">
              <input class="btn" name="register" type="submit" value="登録する" />
            </div>
          </form>
        </div>
      </main>
    </div>
    <?php $_SESSION['error'] = ''; ?>
   <?php include('footer.php'); ?>

