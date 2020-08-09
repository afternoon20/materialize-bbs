<?php
  require_once('config.php');
  require_once('initialForm.php');
  include('header.php');
?>
    <div class="container">
      <span class="message red-text"></span>
      <h2 class="center center">掲示板</h2>
      <?php If(!isset($_SESSION['user_name'])) : ?>
        <p class="center">ログインすると掲示板の作成、編集、削除ができます。</p>
      <?php endif ; ?>
      <main>
        <div class="entry-list">
          <?php If(isset($_SESSION['user_name'])) : ?>
            <a href="create.php" class="waves-effect waves-light btn blue"><i class="material-icons left">add</i>新規作成</a>
          <?php else : ?>
            <span class="btn disabled"><i class="material-icons left">add</i>新規作成</span>
          <?php endif ; ?>
          <!-- 一覧表示 -->
          <?php foreach($mysql as $entry) : ?>
             <div class="entry">
            <header class="entry-header">
              <h3 class="entry-ttl"><?php echo $entry['title'] ?></h3>
              <div class="entry-date">
                投稿日：
                <?php $created_date;
                      $created_date = date('Y.m.d',strtotime($entry['created_date'])); 
                ?>
                <time><?php echo $created_date ?></time>
              </div>
            </header>
            <div class="entry-body">
             <?php echo nl2br($entry['body']); ?>
            </div>
            <div class="entry-more">
              <a href="<?php echo "post.php"."?post=".$entry['post_id'] ?>">続きをみる</a>
              <div class="entry-comment">コメント (<span class="entory-comment__amount"><?php 
                  if(is_null($entry['count(comment_id)'])){
                    echo '0';
                  } else{
                    echo $entry['count(comment_id)'];
                  };
                ?></span>)
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <!-- ページネーション -->
        <ul class="pagination center">
          <?php
            $prev = $cur_page-1;
            $next = $cur_page+1;
          ?>
          <!-- 前のページ -->
          <?php if($cur_page <= 1) :?>
            <li class="disabled">
              <a href=""><i class="material-icons">chevron_left</i></a>
            </li>
          <?php else :?>
            <li class="waves-effect">
              <a href="../index.php/p=<?php echo $prev ?>"><i class="material-icons">chevron_left</i></a>
            </li>
          <?php endif; ?>  
          <!-- ページ数の表示 -->
          <?php for($i =1; $i <= $total_page; $i++) :?>
            <?php if($i == $cur_page) :?>
            <li class="active"><a href=""><?php echo $i ?></a></li>
            <?php else :?>
            <li class="waves-effect"><a href="../index.php?p=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php endif;?>
          <?php endfor; ?>
          <!-- 次のページ -->
          <?php if($cur_page == $total_page) :?>
            <li class="disabled">
              <a href=""><i class="material-icons">chevron_right</i></a>
            </li>
          <?php else :?>
            <li class="waves-effect">
              <a href="../index.php?p=<?php echo $next ?>"><i class="material-icons">chevron_right</i></a>
            </li>
          <?php endif; ?>
        </ul>
      </main>
    </div>
    <?php include('footer.php'); ?>
