<?php
  require_once('config.php');

  if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Location: index.php');
    exit();

  } else {
    try {
      $pdo = new PDO(HOST, ID, PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
          $error = $e -> getCode();
          $_SESSION['error'] = $error;
          header('Location: error.php');
          exit();

      }
      // ユーザー情報を取得する
      $login_id = $_POST['login_id'];
      $sql = "SELECT * FROM `user` WHERE `login_id` = :login_id" ;
      $mysql = $pdo -> prepare($sql);
      $mysql -> bindValue(':login_id', $login_id);
      try {
        $mysql -> execute();
      } catch(PDOException $e){
        $error = $e -> getCode();
        $_SESSION['error'] = $error;
        header('Location: error.php');
        exit();

      };
      $user = $mysql -> fetch();
      if (!empty($user) && password_verify($_POST['password'],$user['password']) == 1 ) { 
          $_SESSION['user_name'] = $user['user_name'];
          $_SESSION['login_id'] = $user['login_id'];
          $_SESSION['user_id'] = $user['user_id'];
          header("Location: index.php");
          
      } else {
          $_SESSION['error'] = DEFECT;
          header('Location: login.php');
          exit();
      };
  }


?>