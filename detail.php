<?php
session_start();
require_once('funcs.php');
loginCheck();

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */
$id = $_GET["id"];

try {
    $db_name = 'gs_db2'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// 3.データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id= :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);//PARAM_INTなので注意
$status = $stmt->execute(); //実行

$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

// var_dump($result);

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ編集</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">店舗一覧</a></div>
            </div>
        </nav>
    </header>

    <div>
        <h1>店舗登録フォーム</h1>
    </div>

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="tempo">
            <fieldset>
                <legend>店舗登録フォーム</legend>
                <label>店番：<input type="text" name="tempo_no" value="<?= $result['tempo_no'] ?>"></label><br>
                <label>店舗名：<input type="text" name="tempo_name" value="<?= $result['tempo_name'] ?>"></label><br>
                <label>郵便番号：<input type="text" name="postcode" value="<?= $result['postcode'] ?>"></label><br>
                <label>住所：<input type="text" name="address" value="<?= $result['address'] ?>"></label><br>
                <label>電話番号：<input type="text" name="phone_no" value="<?= $result['phone_no'] ?>"></label><br>
                <label>開店日：<input type="date" name="open_date" value="<?= $result['open_date'] ?>"></label><br>
                <label>閉店日：<input type="date" name="close_date" value="<?= $result['close_date'] ?>"></label><br>
                <input type="hidden" name="id" value="<?= $result["id"] ?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>
