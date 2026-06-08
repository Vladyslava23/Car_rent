<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="et">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Autorent</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Autorent</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Avaleht</a></li>
            <li class="nav-item"><a class="nav-link" href="autod.php">Autod</a></li>
            <li class="nav-item"><a class="nav-link" href="hinnad.php">Hinnad</a></li>
            <li class="nav-item"><a class="nav-link" href="kontakt.php">Kontakt</a></li>
        </ul>

        <div class="d-flex me-3">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logi välja</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light btn-sm me-2">Logi sisse</a>
                <a href="register.php" class="btn btn-primary btn-sm">Registreeru</a>
            <?php endif; ?>
        </div>

        <form class="d-flex" method="get" action="autod.php">
            <input class="form-control me-2" type="search" name="q" placeholder="Otsi marki või mudelit" value="<?= e($_GET['q'] ?? '') ?>">
            <button class="btn btn-outline-light" type="submit">Otsi</button>
        </form>
    </div>
</div>
</nav>

<main class="container py-4">