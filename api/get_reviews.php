<?php
header('Access-Control-Allow-Origin: *');
require '../config.php';
$stmt = $pdo->query("SELECT * FROM reviews ORDER BY created_at DESC");
echo json_encode($stmt->fetchAll());