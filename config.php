<?php

  session_start();
  
  // タイムゾーン設定
  date_default_timezone_set('Asia/Tokyo');

  // DB情報
  define("HOST",'mysql:dbname=mydb;host=localhost;charset=utf8');
  define("ID",'root');
  define("PASS",'root');
  define("DB_ATTR","PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION");
 
  // メッセージ一覧
  define("UNUSABLE","ご入力いただいたユーザIDは既に使用されています。");
  define("VALID","入力に不備があります。");
  define("DEFECT","ログインIDまたはパスワードが違います。");
  define("EMPTY_LOGIN_ID","入力に不備があります。");
  define("EMPTY_PASSWORD","入力に不備があります。");
  
  // サイト情報
  define("TITLE","Materialize-bbs");
  define("URL",$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  define("ROOT",'http://localhost:8001');

?>