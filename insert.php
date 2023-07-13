<?php

//1. POSTデータ取得

$tempo_no = isset($_POST["tempo_no"]) ? $_POST["tempo_no"] : null;
$tempo_name = isset($_POST["tempo_name"]) ? $_POST["tempo_name"] : null;
$postcode = isset($_POST["postcode"]) ? $_POST["postcode"] : null;
$address = isset($_POST["address"]) ? $_POST["address"] : null;
$phone_no = isset($_POST["phone_no"]) ? $_POST["phone_no"] : null;
$open_date = isset($_POST["open_date"]) ? $_POST["open_date"] : null;
$close_date = isset($_POST["close_date"]) ? $_POST["close_date"] : null;

//2. DB接続します
//*** function化する！  *****************
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

// 3. データ登録SQLの準備と実行
// 1. 重複チェックのためのSQL文を準備
$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM gs_bm_table WHERE tempo_no = :tempo_no");
$checkStmt->bindValue(':tempo_no', $tempo_no, PDO::PARAM_INT);
$checkStmt->execute();
$count = $checkStmt->fetchColumn();

// 2. 結果を判定して処理を分岐
if ($count > 0) {
    // 重複エラーの処理
    exit('既に登録されている店番です。別の店番を入力してください。<br><a href="index.php">登録画面に戻る</a>');
} else {
    // 重複がない場合はデータを登録
    // ここで$tempo_noの入力チェックを行う
    if (empty($tempo_no)) {
      exit('店番が入力されていません。<br><a href="index.php">登録画面に戻る</a>');
    }

    // データ登録の準備と実行
      $stmt = $pdo->prepare("INSERT INTO 
                        gs_bm_table(
                            tempo_no, tempo_name, postcode, address, phone_no, open_date, close_date
                          ) VALUES(
                            :tempo_no, :tempo_name, :postcode, :address, :phone_no, :open_date, :close_date
                            )");
  }

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':tempo_no', $tempo_no, PDO::PARAM_INT);
$stmt->bindValue(':tempo_name', $tempo_name, PDO::PARAM_STR);
$stmt->bindValue(':postcode', $postcode, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':phone_no', $phone_no, PDO::PARAM_STR);
$stmt->bindValue(':open_date', $open_date, PDO::PARAM_STR);
$stmt->bindValue(':close_date', $close_date, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
