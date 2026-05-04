<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$name || !$email || strlen($password) < 6) {
        $error = 'Täida väljad. Parool peab olema vähemalt 6 märki.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $email, $hash);
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $name;
            redirect('autod.php');
        } else {
            $error = 'E-post on juba kasutusel või tekkis viga.';
        }
    }
}
require_once __DIR__ . '/../inc/header.php';
?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card shadow-sm"><div class="card-body">
        <h1 class="h3">Registreeri kasutaja</h1>
        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
        <form method="post">
            <input class="form-control mb-3" name="name" placeholder="Nimi" required>
            <input class="form-control mb-3" type="email" name="email" placeholder="E-post" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Parool" required>
            <button class="btn btn-primary w-100">Registreeri</button>
        </form>
    </div></div>
</div></div>
<?php require_once __DIR__ . '/../inc/footer.php'; ?>
