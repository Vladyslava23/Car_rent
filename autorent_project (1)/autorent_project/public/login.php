<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        redirect('autod.php');
    } else {
        $error = 'Vale e-post või parool.';
    }
}
require_once __DIR__ . '/../inc/header.php';
?>
<div class="row justify-content-center"><div class="col-md-5">
    <div class="card shadow-sm"><div class="card-body">
        <h1 class="h3">Kasutaja login</h1>
        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
        <form method="post">
            <input class="form-control mb-3" type="email" name="email" placeholder="E-post" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Parool" required>
            <button class="btn btn-primary w-100">Logi sisse</button>
        </form>
    </div></div>
</div></div>
<?php require_once __DIR__ . '/../inc/footer.php'; ?>
