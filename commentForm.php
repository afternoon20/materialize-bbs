<?php
  require_once('config.php');

  if(empty($_POST['url'])){
    
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
  // コメントの追加
  $post_id = $_POST['post_id'];
  $login_id = $_SESSION['login_id'];
  $body = $_POST['body'];
  $sql = "INSERT INTO `comment`(`post_id`,`login_id`,`body`) VALUES(:post_id, :login_id, :body)" ;
  $mysql = $pdo -> prepare($sql);
  $mysql -> bindValue(':post_id', $post_id);
  $mysql -> bindValue(':login_id', $login_id);
  $mysql -> bindValue(':body', $body);

  try {
    $mysql -> execute();
  } catch(PDOException $e){
    $error = $e -> getCode();
    $_SESSION['error'] = $error;
    header('Location: error.php');
    exit();
  };

  // 投稿ページに遷移
  header("Location: post.php?post=${post_id} ");
  exit();

  }

  

 
?> 