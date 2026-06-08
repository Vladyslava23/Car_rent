<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "INSERT INTO cars
    (mark, model, engine, fuel, price, image, year, transmission, seats, description, status)
    VALUES
    (
        '{$_POST['mark']}',
        '{$_POST['model']}',
        '{$_POST['engine']}',
        '{$_POST['fuel']}',
        '{$_POST['price']}',
        '{$_POST['image']}',
        '{$_POST['year']}',
        '{$_POST['transmission']}',
        '{$_POST['seats']}',
        '{$_POST['description']}',
        '{$_POST['status']}'
    )";

    mysqli_query($conn, $sql);

    redirect('index.php');
}

require_once __DIR__ . '/_admin_header.php';
?>

<h1>Lisa auto</h1>

<form method="post">

    <?php require 'car_form.php'; ?>

</form>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>

