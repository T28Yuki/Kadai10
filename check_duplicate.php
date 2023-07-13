<?php

$tempo_no = isset($_GET["tempo_no"]) ? $_GET["tempo_no"] : null;

try {
    $db_name = 'gs_db2';
    $db_id   = 'root';
    $db_pw   = '';
    $db_host = 'localhost';
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

$stmt = $pdo->prepare('SELECT COUNT(*) FROM gs_bm_table WHERE tempo_no = :tempo_no');
$stmt->bindValue(':tempo_no', $tempo_no, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->fetchColumn();

$response = array();
$response['duplicate'] = ($count > 0);

header('Content-Type: application/json');
echo json_encode($response);

?>
