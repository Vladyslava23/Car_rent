<?php
require_once __DIR__ . '/../inc/functions.php';
require_admin();
?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Autorent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin</a>
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Autod</a>
            <a class="nav-link" href="reservations.php">Broneeringud</a>
            <a class="nav-link" href="logout.php">Logi välja</a>
            <a class="nav-link" href="../public/index.php">Avalik leht</a>
        </div>
    </div>
</nav>
<main class="container py-4">
