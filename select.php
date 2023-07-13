<?php
// funcs.phpを読込む
session_start();
require_once('funcs.php');
loginCheck();

//1.  DB接続します
try {
  $db_name = 'gs_db2'; //データベース名
  $db_id   = 'root'; //アカウント名
  $db_pw   = ''; //パスワード：MAMPは'root'
  $db_host = 'localhost'; //DBホスト
//ID:'root', Password: xamppは 空白 ''
$pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
exit('DB Connection Error:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示

$view = "";
if ($status == false) {
  // execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
} else {
  // Selectデータの数だけ自動でループしてくれる
  // FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= "<p>";

    $view .= '<a href="detail.php?id=' . $result["id"] . '">';
    $view .= h($result["tempo_no"]) . " : " . h($result["tempo_name"]) . " : " . h($result["postcode"]) .
      " : " . h($result["address"]) . " : " . h($result["phone_no"]);
    $view .= '</a>';

    if($_SESSION['kanri_flg'] !== 0){
      $view .= '<a href="delete.php?id=' . $result["id"] . '">';
      $view .= '削除';
      $view .= '</a>';
    }

    $view .= "</p>";
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>店舗登録フォーム</title>
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  div{
    padding: 10px;
    font-size:16px;
    }
</style>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ホーム画面に戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <a href="detail.php"></a>
      <?= $view ?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
