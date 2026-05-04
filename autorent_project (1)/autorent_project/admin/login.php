<?php
require_once __DIR__ . '/../inc/functions.php';
$error = '';
// Vaikimisi: admin@example.com / admin123
$adminEmail = 'admin@example.com';
$adminHash = password_hash('admin123', PASSWORD_DEFAULT);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email === $adminEmail && password_verify($password, $adminHash)) {
        $_SESSION['is_admin'] = true;
        redirect('index.php');
    }
    $error = 'Vale admini e-post või parool.';
}
?>
<!doctype html><html lang="et"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><main class="container py-5"><div class="row justify-content-center"><div class="col-md-5"><div class="card shadow-sm"><div class="card-body">
<h1 class="h3">Admin login</h1>
<p class="text-secondary">admin@example.com / admin123</p>
<?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="post"><input class="form-control mb-3" type="email" name="email" placeholder="E-post" required><input class="form-control mb-3" type="password" name="password" placeholder="Parool" required><button class="btn btn-primary w-100">Logi sisse</button></form>
</div></div></div></div></main></body></html>
