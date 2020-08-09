<?php
  require_once('editForm.php');
  include('header.php');
?>
    <div class="container">
      <a href="index.php" class="teal-text lighten-3 breadcrumbs"><span class="icon"><i class="material-icons">home</i></span>ホーム</a>
      <span>&gt;</span>
      <a class="teal-text lighten-3" href="../post.php/?post=<?php echo $post_id?>"><?php echo htmlspecialchars($entry['title'],ENT_QUOTES,"UTF-8"); ?></a>
      <span>&gt;</span>
      <h2 class="center center">編集する</h2>
      <p class="center"><br /></p>
      <main>
        <div class="form-wrapper">
          <form action="editForm.php" method="post">
            <label>タイトル(変更はできません。)</label>
            <input type="text" name="name" disabled value="<?php echo htmlspecialchars($entry['title'],ENT_QUOTES,"UTF-8"); ?>" />
            <label>内容</label>
            <textarea name="body" class="materialize-textarea" maxlength="255" cols="30" rows="10"><?php echo htmlspecialchars($entry['body'],ENT_QUOTES,"UTF-8"); ?></textarea>
            <input type="hidden" name="post_id" value="<?php echo $_GET['post'] ;?>">
            <div class="center form__btn">
              <input class="btn" type="submit" value="編集する" />
            </div>
          </form>
        </div>
      </main>
    </div>
  <?php include('footer.php'); ?>
