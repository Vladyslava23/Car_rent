<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';
require_admin();
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('DELETE FROM cars WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
redirect('index.php');
