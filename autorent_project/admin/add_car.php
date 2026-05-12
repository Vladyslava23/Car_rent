<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mark = $_POST['mark'];
    $model = $_POST['model'];
    $engine = $_POST['engine'];
    $fuel = $_POST['fuel'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $year = $_POST['year'];
    $transmission = $_POST['transmission'];
    $seats = $_POST['seats'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "
        INSERT INTO cars
        (mark, model, engine, fuel, price, image, year, transmission, seats, description, status)

        VALUES

        ('$mark', '$model', '$engine', '$fuel', '$price', '$image',
        '$year', '$transmission', '$seats', '$description', '$status')
    ";

    $conn->query($sql);

    redirect('index.php');
}

require_once __DIR__ . '/_admin_header.php';

?>

<h1 class="h2 mb-4">Lisa auto</h1>

<form method="post" class="card card-body shadow-sm">

    <?php require __DIR__ . '/car_form.php'; ?>

</form>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>