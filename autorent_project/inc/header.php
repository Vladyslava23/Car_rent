<?php require_once __DIR__ . '/functions.php'; ?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title>Autorent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Autorent</a>

        <div class="navbar-nav me-auto">
            <a class="nav-link" href="index.php">Avaleht</a>
            <a class="nav-link" href="autod.php">Autod</a>
            <a class="nav-link" href="hinnad.php">Hinnad</a>
            <a class="nav-link" href="kontakt.php">Kontakt</a>
        </div>

        <div class="navbar-nav me-3">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <a class="nav-link" href="logout.php">Logi välja</a>
            <?php else: ?>
                <a class="nav-link" href="login.php">Logi sisse</a>
                <a class="nav-link" href="register.php">Registreeru</a>
            <?php endif; ?>
        </div>

        <form class="d-flex" method="get" action="autod.php">
            <input class="form-control me-2" type="search" name="q" placeholder="Otsi...">
            <button class="btn btn-outline-light" type="submit">Otsi</button>
        </form>
    </div>
</nav>

<main class="container py-4">