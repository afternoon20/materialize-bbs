<?php
  require_once('config.php');
  If(!isset($_SESSION['user_name'])){
    header('Location: index.php');
  };
  include('header.php');
?>
    <div class="container">
     <a href="index.php" class="teal-text lighten-3 breadcrumbs"><span class="icon"><i class="material-icons">home</i></span>ホーム</a>
     <span>&gt;</span>
      <h2 class="center center">新規作成</h2>
      <p class="center"><br /></p>
      <main>
        <div class="form-wrapper">
          <form action="createForm.php" method="post">
            <label>タイトル (50文字以内)</label>
            <input type="text" required maxlength='50' name="title" title="タイトルは必ず入力して下さい。"/>
            <label>内容 (255文字以内)</label>
            <textarea name="body" maxlength='255' class="materialize-textarea" cols="30" rows="10"></textarea>
            <div class="center form__btn">
              <input class="btn" name="create" type="submit" value="作成する" />
            </div>
          </form>
        </div>
      </main>
    </div>
  <?php include('footer.php'); ?>
