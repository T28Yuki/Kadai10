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
$id = isset($_GET["id"]) ? $_GET["id"] : null;

try {
    $db_name = 'gs_db2'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_member_table WHERE id= :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 実行結果の取得
if ($status === false) {
    // SQL実行時にエラーが発生した場合の処理
    $error = $stmt->errorInfo();
    exit('SQL Error:' . $error[2]);
}

// 結果の取得
$result = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>ユーザー編集</title>
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
        <nav class="navbar login-default">
            <div class="login-fluid">
                <div class="login-header"><a class="login-brand" href="select_u.php">ユーザ一覧</a></div>
            </div>
        </nav>
    </header>

    <div>
        <h1>ユーザー更新フォーム</h1>
    </div>

    <!-- Main[Start] -->
    <form method="POST" action="update_u.php">
        <div class="user">
            <fieldset>
                <legend>ユーザー登録フォーム</legend>
                <label>ユーザー名：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>ログインID：<input type="text" name="lid" value="<?= $result['lid'] ?>"></label><br>
                <label>パスワード：<input type="text" name="lpw" value="<?= $result['lpw'] ?>"></label><br>
                <label>管理者ステータス：<input type="text" name="kanri_flg" value="<?= $result['kanri_flg'] ?>"></label><br>
                <label>ステータス状況：<input type="text" name="life_flg" value="<?= $result['life_flg'] ?>"></label><br>
                <input type="hidden" name="id" value="<?= $result["id"] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>
