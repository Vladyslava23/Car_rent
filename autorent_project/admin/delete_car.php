<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_admin();

$id = $_GET['id'];

$sql = "DELETE FROM cars WHERE id = $id";

mysqli_query($conn, $sql);

redirect('index.php');

