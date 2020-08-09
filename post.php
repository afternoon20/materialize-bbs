<?php
  require_once('config.php');
  require_once('postForm.php');
  include('header.php');
?>
    <div class="container">
      <a href="index.php" class="teal-text lighten-3 breadcrumbs"><span class="icon"><i class="material-icons">home</i></span>ホーム</a>
      <span>&gt;</span>
      <?php If(!isset($_SESSION['user_name'])) : ?>
        <p class="center">ログインすると、掲示板の作成、編集、削除ができます。</p>
      <?php endif ; ?>
      <div class="post__btn">
        <?php If(isset($_SESSION['user_name'])) : ?>
          <a href="/edit.php?post=<?php echo $post_id; ?>" class="waves-effect waves-light btn blue">編集する</a>
          <a class="waves-effect waves-light btn grey lighten-1 modal-trigger" href="#modal-del">削除</a>
        <?php else : ?>
          <span class="btn disabled">編集する</span>
          <span class="btn disabled" href="#modal-del">削除</span>
        <?php endif ; ?>
      </div>
      <main>
          <div class="entry">
            <header class="entry-header entry-header--post">
              <h3 class="entry-ttl"><?php echo htmlspecialchars($entry['title'],ENT_QUOTES,"UTF-8"); ?></h3>
              <div class="entry-date">
                投稿日：
                <?php $created_date;
                      $created_date = date('Y.m.d',strtotime(htmlspecialchars($entry['created_date'],ENT_QUOTES,"UTF-8"))); 
                ?>
                <time><?php echo $created_date ?></time>
              </div>
            </header>
            <div class="entry-body">
              <?php echo nl2br($entry['body']); ?>
            </div>
            <div class="comment-wrapper">
              <form action="commentForm.php" method="post">
                <label>コメント (255文字以内)
                <textarea name="body" class="materialize-textarea" cols="30" rows="10" maxlength="255" required></textarea>
                </label>
                <input type="hidden" name="post_id" value="<?php echo $entry['post_id'];?>">
                <input type="hidden" name="url" value= "<?php echo $_SERVER["PHP_SELF"]; ?>" >
                <div class="center form__btn">
                  <input class="btn" type="submit" value="コメントする" />
                </div>
              </form>    
            <!-- コメント一覧 -->
            <div class="comment-list">
              <?php 
                $comment_num = 0;  
                foreach($mysql_comments as $comment) : 
                  $comment_num += 1;    
              ?>
                <div class="comment">
                <div class="comment-header">
                  <span class="comment__num"><?php echo $comment_num ?></span>
                  <span class="comment__name"><?php 
                    if(is_null($comment['user_name'])){
                      echo '名無し';
                    }else{
                      echo $comment['user_name'];
                    }
                  ?></span>
                  <div class="comment__date">
                    投稿日：
                    <time><?php echo $comment['created_date'];?></time>
                  </div>
                </div>
                <div class="comment-body">
                  <?php 
                    $body = nl2br($comment['body']);
                    echo $body ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </main>
      <!-- ポップアップ表示 -->
        <div id="modal-del" class="modal">
          <div class="modal-content post-modal">
            <h3>本当に削除しますか？</h3>
            <p>一度削除すると、復元はできません。<br>コメントも削除されます。</p>
          </div>
          <div class="modal-footer">
            <form action="../deleteForm.php" method="post">
              <input type="hidden" name="post_id" value="<?php echo $entry['post_id'];?>">
              <input class="btn blue" type="submit" value="削除する" />
            </form> 
          </div>
        </div>
    </div>
  <?php include('footer.php'); ?>
