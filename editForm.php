<?php
  require_once('config.php');
  // ログインしていない場合はindex.phpへリダイレクト
  If(!isset($_SESSION['user_name'])){
      header('Location:../index.php');
  };

  // 編集ボタンを押したときの処理
  if(!empty($_POST['post_id'])){
    try{
    $pdo = new PDO(HOST,ID,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
    }
    
    // 投稿の更新
    $post_id = $_POST['post_id'];
    $body = $_POST['body'];
    $update = date("Y-m-d H:i:s", time());

    $sql = "UPDATE `post` SET `body` = :body, `update_date` =:update_date WHERE `post_id` = :post_id " ;
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':body', $body);
    $mysql -> bindValue(':update_date', $update);
    $mysql -> bindValue(':post_id', $post_id);
    try {
        $mysql -> execute();
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
    };

    header('Location: post.php/?post='.$post_id);
  // post_idが空白場合
  } elseif( empty($_GET['post']) ) {    
    header('Location: ../index.php');
  
  } else {
    try{
    $pdo = new PDO(HOST,ID,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
    }
    
    // 掲示板の情報を取得する
    $post_id = $_GET['post'];
    $sql = "SELECT * FROM `post` WHERE `post_id` = :post_id " ;
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':post_id', $post_id);
    $mysql -> execute();
    $entry = $mysql -> fetch();
    
    // 件数を取得
    $sql = "SELECT COUNT(*) FROM `post` WHERE `post_id` = :post_id ";
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':post_id', $post_id);
    $mysql -> execute();
    $cnt = $mysql -> fetch();
    
    if($cnt[0] == 0){
      header('Location:../index.php');
    }
  };
?>