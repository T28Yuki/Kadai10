<?php

//1. POSTデータ取得

$name = isset($_POST["name"]) ? $_POST["name"] : null;
$lid = isset($_POST["lid"]) ? $_POST["lid"] : null;
$lpw = isset($_POST["lpw"]) ? $_POST["lpw"] : null;
$kanri_flg = isset($_POST["kanri_flg"]) ? $_POST["kanri_flg"] : null;
$life_flg = isset($_POST["life_flg"]) ? $_POST["life_flg"] : null;

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
$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM gs_member_table WHERE lid = :lid AND lpw = :lpw");
$checkStmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$checkStmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$checkStmt->execute();
$count = $checkStmt->fetchColumn();

// 2. 結果を判定して処理を分岐
if ($count > 0) {
    // 重複エラーの処理
    exit('既に登録されているログインIDです。別のIDを入力してください。<br><a href="registerS.php">登録画面に戻る</a>');
} else {
    // 重複がない場合はデータを登録
    // ここで$login_idの入力チェックを行う
    if (empty($lid)) {
      exit('ログインIDが入力されていません。<br><a href="register.php">登録画面に戻る</a>');
    }

    // 重複がない場合はデータを登録
      $stmt = $pdo->prepare("INSERT INTO 
      gs_member_table(
          name, lid, lpw, kanri_flg, life_flg
        ) VALUES(
          :name, :lid, :lpw, :kanri_flg, :life_flg
          )");
  }

    //  2. バインド変数を用意
    // Integer 数値の場合 PDO::PARAM_INT
    // String文字列の場合 PDO::PARAM_STR

    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
    $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);
    $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);

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

