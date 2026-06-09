<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

$id = $_GET['id'];

$sql = "SELECT * FROM cars WHERE id = $id";
$result = mysqli_query($conn, $sql);
$car = mysqli_fetch_assoc($result);

if (!$car) {
    die('Autot ei leitud.');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SESSION['user_id'])) {
        $error = 'Broneerimiseks logi sisse.';
    } else {

        $start = $_POST['start_date'];
        $end = $_POST['end_date'];
        $days = days_between($start, $end);

        if ($days < 1) {
            $error = 'Vali õiged kuupäevad.';
        } else {

            $checkSql = "
                SELECT * FROM reservations
                WHERE car_id = $id
                AND status = 'active'
                AND '$start' <= end_date
                AND '$end' >= start_date
            ";

            $check = mysqli_query($conn, $checkSql);

            if (mysqli_num_rows($check) > 0) {
                $error = 'See auto on juba broneeritud.';
            } else {

                $user_id = $_SESSION['user_id'];
                $total = $days * $car['price'];

                $sql = "
                    INSERT INTO reservations
                    (user_id, car_id, start_date, end_date, total_price, status)
                    VALUES
                    ($user_id, $id, '$start', '$end', $total, 'active')
                ";

                mysqli_query($conn, $sql);

                $success = 'Broneering salvestatud. Hind kokku: ' . $total . ' €';
            }
        }
    }
}

require_once __DIR__ . '/../inc/header.php';
?>

<div class="row">

    <div class="col-md-7">
        <img src="<?= e($car['image']) ?>" class="img-fluid rounded">
    </div>

    <div class="col-md-5">
        <h1><?= e($car['mark']) ?> <?= e($car['model']) ?></h1>

        <p><?= e($car['description']) ?></p>

        <ul class="list-group mb-3">
            <li class="list-group-item">Aasta: <?= e($car['year']) ?></li>
            <li class="list-group-item">Mootor: <?= e($car['engine']) ?></li>
            <li class="list-group-item">Kütus: <?= e($car['fuel']) ?></li>
            <li class="list-group-item">Käigukast: <?= e($car['transmission']) ?></li>
            <li class="list-group-item">Kohti: <?= e($car['seats']) ?></li>
            <li class="list-group-item">Staatus: <?= e($car['status']) ?></li>
            <li class="list-group-item">Hind: <?= e($car['price']) ?> €/päev</li>
        </ul>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= e($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= e($success) ?></div>
        <?php endif; ?>

        <form method="post" class="card card-body">
            <h4>Broneeri auto</h4>

            <label>Algus</label>
            <input type="date" name="start_date" class="form-control mb-3" required>

            <label>Lõpp</label>
            <input type="date" name="end_date" class="form-control mb-3" required>

            <button class="btn btn-primary">Salvesta broneering</button>
        </form>
    </div>

</div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>