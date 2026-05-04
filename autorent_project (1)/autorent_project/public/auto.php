<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM cars WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$car = $stmt->get_result()->fetch_assoc();
if (!$car) { die('Autot ei leitud.'); }

$error = '';
$success = '';
$totalPrice = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_SESSION['user_id'])) {
        $error = 'Broneerimiseks logi kasutajana sisse.';
    } else {
        $start = $_POST['start_date'] ?? '';
        $end = $_POST['end_date'] ?? '';
        $days = days_between($start, $end);
        if (!$start || !$end || $days < 1) {
            $error = 'Vali korrektne algus- ja lõppkuupäev. Lõpp peab olema algusest hilisem.';
        } else {
            $check = $conn->prepare("SELECT id FROM reservations WHERE car_id = ? AND status = 'active' AND (? <= end_date) AND (? >= start_date) LIMIT 1");
            $check->bind_param('iss', $id, $start, $end);
            $check->execute();
            if ($check->get_result()->num_rows > 0) {
                $error = 'See auto on valitud perioodil juba broneeritud.';
            } else {
                $totalPrice = $days * (float)$car['price'];
                $ins = $conn->prepare('INSERT INTO reservations (user_id, car_id, start_date, end_date, total_price, status) VALUES (?, ?, ?, ?, ?, "active")');
                $uid = (int)$_SESSION['user_id'];
                $ins->bind_param('iissd', $uid, $id, $start, $end, $totalPrice);
                $ins->execute();
                $success = 'Broneering salvestatud. Koguhind: ' . number_format($totalPrice, 2) . ' €';
            }
        }
    }
}
require_once __DIR__ . '/../inc/header.php';
?>
<div class="row g-4">
    <div class="col-lg-7">
        <img src="<?= e($car['image']) ?>" class="img-fluid rounded-4 shadow" alt="<?= e($car['mark'].' '.$car['model']) ?>">
    </div>
    <div class="col-lg-5">
        <h1><?= e($car['mark'].' '.$car['model']) ?></h1>
        <p class="lead text-secondary"><?= e($car['description']) ?></p>
        <ul class="list-group mb-3">
            <li class="list-group-item">Aasta: <strong><?= e($car['year']) ?></strong></li>
            <li class="list-group-item">Mootor: <strong><?= e($car['engine']) ?></strong></li>
            <li class="list-group-item">Kütus: <strong><?= e($car['fuel']) ?></strong></li>
            <li class="list-group-item">Käigukast: <strong><?= e($car['transmission']) ?></strong></li>
            <li class="list-group-item">Kohti: <strong><?= e($car['seats']) ?></strong></li>
            <li class="list-group-item">Staatus: <strong><?= e($car['status']) ?></strong></li>
            <li class="list-group-item">Hind: <strong><?= e($car['price']) ?> €/päev</strong></li>
        </ul>
        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
        <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
        <form method="post" class="card card-body shadow-sm">
            <h2 class="h5">Broneeri auto</h2>
            <div class="mb-3">
                <label class="form-label">Algus</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lõpp</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <button class="btn btn-primary">Arvuta koguhind ja salvesta</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../inc/footer.php'; ?>
