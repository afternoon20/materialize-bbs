<?php
  require_once('config.php');
  if( empty($_POST['title'])) {
    header('Location: create.php');

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
    $title = $_POST['title'];
    $body = $_POST['body'];
    $sql = "INSERT INTO `post`(title,body) VALUES(:title,:body)" ;
    $mysql = $pdo -> prepare($sql);
    $mysql -> bindValue(':title', $title);
    $mysql -> bindValue(':body', $body);
    try {
      $mysql -> execute();
    } catch(PDOException $e){
      $error = $e -> getCode();
      $_SESSION['error'] = $error;
      header('Location: error.php');
    };
    header('Location: index.php');
  };
?>