<?php

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

$tempo_no = isset($_POST["tempo_no"]) ? $_POST["tempo_no"] : null;
$tempo_name = isset($_POST["tempo_name"]) ? $_POST["tempo_name"] : null;
$postcode = isset($_POST["postcode"]) ? $_POST["postcode"] : null;
$address = isset($_POST["address"]) ? $_POST["address"] : null;
$phone_no = isset($_POST["phone_no"]) ? $_POST["phone_no"] : null;
$open_date = isset($_POST["open_date"]) ? $_POST["open_date"] : null;
$close_date = isset($_POST["close_date"]) ? $_POST["close_date"] : null;
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

$stmt = $pdo->prepare('UPDATE gs_bm_table 
                        SET tempo_no  = :tempo_no,
                            tempo_name = :tempo_name,
                            postcode = :postcode,
                            address = :address,
                            phone_no = :phone_no,
                            open_date = :open_date,
                            close_date = :close_date
                            WHERE id = :id ;');

$stmt->bindValue(':tempo_no', $tempo_no, PDO::PARAM_INT);
$stmt->bindValue(':tempo_name', $tempo_name, PDO::PARAM_STR);
$stmt->bindValue(':postcode', $postcode, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':phone_no', $phone_no, PDO::PARAM_STR);
$stmt->bindValue(':open_date', $open_date, PDO::PARAM_STR);
$stmt->bindValue(':close_date', $close_date, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header("Location: select.php");
    exit();
}

