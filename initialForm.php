<?php
  try{
    $pdo = new PDO(HOST,ID,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch(PDOException $e){
    echo $e -> getMessage();
      // $error = $e -> getCode();
      // $_SESSION['error'] = $error;
      // header('Location: error.php');
      exit();
  }

  /////////////////////////////////////
  ///// ページネーションの設定
  /////////////////////////////////////
  
  // １ページあたりの件数
  define('PER_PAGE',10);

  // 現在のページを取得
  if($_GET['p']>0){
    $cur_page = $_GET['p'];
  } else{
    $cur_page = 1;
  };
  // echo '今のページ:'.$cur_page.'<br>';

  // 表示する最初の記事
  $fir_post = (PER_PAGE * $cur_page) - PER_PAGE;

  if($_GET['p']!==''){
    $cntsql ="SELECT COUNT(*)  AS CNT FROM `post`";
    try {
      $cnt = $pdo -> query($cntsql);
      
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
      exit();
    };
    // 投稿の総数
    $cntf = $cnt -> fetch();
    $total = $cntf[0];
    // ページ総数
    $total_page = ceil($total / PER_PAGE);
    // echo '総件数:'.$total.'<br>';
    // echo 'ページ数:'.$total_page.'<br>';
    // echo '１番目の投稿:'.$fir_post.'<br>';
  }

  /////////////////////////////////////
  ///// 表示する投稿の取得
  /////////////////////////////////////
  // 投稿一覧の取得
  $sql = "SELECT POST.`post_id`,`title`,`body`,`created_date`,`count(comment_id)` FROM `post` AS POST  LEFT JOIN (SELECT post_id, count(comment_id) FROM `comment` GROUP BY `post_id`)  AS COMMENT ON  COMMENT.`post_id` =  POST.`post_id`  \n"
    . "ORDER BY `POST`.`post_id`  DESC LIMIT ${fir_post},".PER_PAGE;

  try {
      $mysql = $pdo -> query($sql);
      
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
      exit();
    };
?>