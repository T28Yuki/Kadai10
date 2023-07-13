<?php

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

$name = isset($_POST["name"]) ? $_POST["name"] : null;
$lid = isset($_POST["lid"]) ? $_POST["lid"] : null;
$lpw = isset($_POST["lpw"]) ? $_POST["lpw"] : null;
$kanri_flg = isset($_POST["kanri_flg"]) ? $_POST["kanri_flg"] : null;
$life_flg = isset($_POST["life_flg"]) ? $_POST["life_flg"] : null;
$id = isset($_POST["id"]) ? $_POST["id"] : null;

try {
    $db_name = 'gs_db2';
    $db_id   = 'root';
    $db_pw   = '';
    $db_host = 'localhost';
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('UPDATE gs_member_table 
            SET name = :name, 
                lid = :lid, 
                lpw = :lpw, 
                kanri_flg = :kanri_flg, 
                life_flg = :life_flg 
                WHERE id = :id');

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header("Location: select_u.php");
    exit();
}
