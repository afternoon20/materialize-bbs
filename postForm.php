<?php 

  require_once('config.php');
  
  // GET以外でリクエストされた場合
  if( $_SERVER["REQUEST_METHOD"] != "GET" ) {
    header('Location:index.php');

} else {
    try{
    $pdo = new PDO(HOST,ID,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: ../error.php');
      exit();
    }
    
    // 掲示板の情報を取得する。
    $post_id = $_GET['post'];
    $sql = "SELECT * FROM `post` WHERE `post_id` = :post_id " ;
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':post_id', $post_id);
    try {
        $mysql -> execute();
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: ../error.php');
      exit();
    };
    $entry = $mysql -> fetch();
    
    // 一致するものがない場合はトップページへ
    $sql = "SELECT COUNT(*) FROM `post` WHERE `post_id` = :post_id ";
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':post_id', $post_id);
    $mysql -> execute();
    $cnt = $mysql -> fetch();
    
    if($cnt[0] == 0){
      header('Location:../index.php');
      exit();
    }

    // コメントを取得する。
    $sql = "SELECT PROC.post_id,PROC.comment_id, PROC.body, PROC.created_date, user_name FROM (SELECT POST.post_id,COMMENT.comment_id,COMMENT.body,COMMENT.created_date, COMMENT.login_id FROM `comment` AS COMMENT  INNER JOIN `post` AS POST ON COMMENT.post_id = POST.post_id WHERE POST.post_id = :post_id) AS PROC LEFT JOIN `user` AS USER ON PROC.login_id = USER.login_id ORDER BY `PROC`.`comment_id` ASC";
    $mysql_comments = $pdo -> prepare($sql);
    $mysql_comments -> bindValue(':post_id', $post_id);
    $mysql_comments -> execute();
    try {
      $mysql_comments -> execute();
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: ../error.php');
      exit();
    };
  }
?>