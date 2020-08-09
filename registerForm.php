<?php

  require_once('config.php');
  
  if( empty($_POST['login_id']) || empty($_POST['password']) || empty($_POST['user_name']) ) {
    // header('Location: register.php');
  } else{

     try {
      $pdo = new PDO(HOST, ID, PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
          $error = $e -> getCode();
          $_SESSION['error'] = $error;
          header('Location: error.php');
          exit();
    }

    $login_id = $_POST['login_id'];
    $user_name = $_POST['user_name'];
    $forms = array($login_id,$_POST['password']);
    foreach($forms as $form){
      $cnt = strlen($form);
      if ((preg_match("/^[a-zA-Z0-9]+$/", $form)) && $cnt <=16 && $cnt >= 6) {

      } else {
        $_SESSION['error'] = VALID;
        header('Location: register.php');
        exit();
      };
    };
    $hash = $_POST['password'];
    $password = password_hash($hash,PASSWORD_DEFAULT);

    //重複チェック
    $sql = "SELECT * FROM `user` WHERE `login_id` = :login_id";
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
    $is_id = $mysql -> fetch();
    

    if(!empty($is_id[0])){
      $_SESSION['error'] = UNUSABLE;
      header('Location: register.php');
      exit();
    }
    
    // ユーザー登録
    $sql = "INSERT INTO `user`(login_id,user_name,password) VALUES(:login_id,:user_name,:password)" ;
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':login_id', $login_id);
    $mysql -> bindValue(':user_name', $user_name);
    $mysql -> bindValue(':password', $password);

    try {
        $mysql -> execute();
      } catch(PDOException $e){
        $error = $e -> getCode();
        $_SESSION['error'] = $error;
        header('Location: error.php');
        exit();
      };
    $_SESSION['user_name'] = $user_name;
    $_SESSION['login_id'] = $login_id;
    header('Location: index.php');
  };
  

  
  


?>