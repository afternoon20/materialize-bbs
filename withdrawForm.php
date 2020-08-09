<?php
  require_once('config.php');

  if(empty($_POST['login_id'])){
    header("Location: index.php");
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

    $login_id = $_SESSION['login_id'];
    $sql = "DELETE FROM `user` WHERE `login_id` = :login_id" ;
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
    $_SESSION = array();
    header("Location: index.php");
    exit();
  }

?>