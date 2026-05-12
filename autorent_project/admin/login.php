<?php
require_once __DIR__ . '/../inc/functions.php';

$error = '';

$emailAdmin = 'admin@example.com';
$passwordAdmin = 'admin123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email == $emailAdmin && $password == $passwordAdmin) {

        $_SESSION['is_admin'] = true;

        redirect('index.php');

    } else {
        $error = 'Vale admini e-post või parool.';
    }
}
?>

<!doctype html>
<html lang="et">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<main class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h1 class="h3 mb-3">Admin login</h1>

                    <p class="text-secondary">
                        admin@example.com / admin123
                    </p>

                    <?php if($error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">

                        <input
                            type="email"
                            name="email"
                            class="form-control mb-3"
                            placeholder="E-post"
                            required
                        >

                        <input
                            type="password"
                            name="password"
                            class="form-control mb-3"
                            placeholder="Parool"
                            required
                        >

                        <button class="btn btn-primary w-100">
                            Logi sisse
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>

</body>
</html>
