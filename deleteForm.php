<?php
  require_once('config.php');
  
  if (empty($_POST['post_id'])) {
    header("Location: index.php ");
  } else{
    try{
    $pdo = new PDO(HOST,ID,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
      exit();
    }

  // 投稿の削除
  $post_id = $_POST['post_id'];
  $sql = "DELETE FROM `post` WHERE `post_id` = :post_id " ;
  $mysql = $pdo -> prepare($sql);
  $mysql -> bindValue(':post_id', $post_id);
  $mysql -> execute();

  // コメントの削除
  $sql = "DELETE FROM `comment` WHERE `post_id` = :post_id " ;
  $mysql = $pdo -> prepare($sql);
  $mysql -> bindValue(':post_id', $post_id);
  $mysql -> execute();
  
  // 投稿ページに遷移
  header("Location: index.php ");
  }
?> 