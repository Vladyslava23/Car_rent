<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

$id = (int)($_GET['id'] ?? 0);

$sql = "SELECT * FROM cars WHERE id = $id";
$result = $conn->query($sql);
$car = $result->fetch_assoc();

if (!$car) {
    die('Autot ei leitud.');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_SESSION['user_id'])) {
        $error = 'Broneerimiseks logi kasutajana sisse.';
    } else {

        $start = $_POST['start_date'];
        $end = $_POST['end_date'];

        $days = days_between($start, $end);

        if ($days < 1) {
            $error = 'Vali korrektne algus- ja lõppkuupäev.';
        } else {

            $sql = "
                SELECT id FROM reservations
                WHERE car_id = $id
                AND status = 'active'
                AND '$start' <= end_date
                AND '$end' >= start_date
            ";

            $check = $conn->query($sql);

            if ($check->num_rows > 0) {
                $error = 'See auto on valitud perioodil juba broneeritud.';
            } else {

                $user_id = $_SESSION['user_id'];
                $total = $days * $car['price'];

                $sql = "
                    INSERT INTO reservations
                    (user_id, car_id, start_date, end_date, total_price, status)
                    VALUES
                    ($user_id, $id, '$start', '$end', $total, 'active')
                ";

                $conn->query($sql);

                $success = 'Broneering salvestatud. Koguhind: ' . number_format($total, 2) . ' €';
            }
        }
    }
}

require_once __DIR__ . '/../inc/header.php';
?>

<div class="row g-4">

    <div class="col-lg-7">
        <img src="<?= e($car['image']) ?>" class="img-fluid rounded-4 shadow" alt="Auto">
    </div>

    <div class="col-lg-5">

        <h1><?= e($car['mark'] . ' ' . $car['model']) ?></h1>

        <p class="lead text-secondary">
            <?= e($car['description']) ?>
        </p>

        <ul class="list-group mb-3">
            <li class="list-group-item">Aasta: <strong><?= e($car['year']) ?></strong></li>
            <li class="list-group-item">Mootor: <strong><?= e($car['engine']) ?></strong></li>
            <li class="list-group-item">Kütus: <strong><?= e($car['fuel']) ?></strong></li>
            <li class="list-group-item">Käigukast: <strong><?= e($car['transmission']) ?></strong></li>
            <li class="list-group-item">Kohti: <strong><?= e($car['seats']) ?></strong></li>
            <li class="list-group-item">Staatus: <strong><?= e($car['status']) ?></strong></li>
            <li class="list-group-item">Hind: <strong><?= e($car['price']) ?> €/päev</strong></li>
        </ul>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <?= e($success) ?>
            </div>
        <?php endif; ?>

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

            <button class="btn btn-primary">
                Arvuta koguhind ja salvesta
            </button>

        </form>

    </div>

</div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>