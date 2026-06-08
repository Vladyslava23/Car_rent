<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_admin();

$id = $_GET['id'];

$sql = "SELECT * FROM cars WHERE id = $id";
$result = mysqli_query($conn, $sql);

$car = mysqli_fetch_assoc($result);

if (!$car) {
    die('Autot ei leitud.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = "
        UPDATE cars SET
        mark = '{$_POST['mark']}',
        model = '{$_POST['model']}',
        engine = '{$_POST['engine']}',
        fuel = '{$_POST['fuel']}',
        price = '{$_POST['price']}',
        image = '{$_POST['image']}',
        year = '{$_POST['year']}',
        transmission = '{$_POST['transmission']}',
        seats = '{$_POST['seats']}',
        description = '{$_POST['description']}',
        status = '{$_POST['status']}'
        WHERE id = $id
    ";

    mysqli_query($conn, $sql);

    redirect('index.php');
}

require_once __DIR__ . '/_admin_header.php';

?>

<h1>Muuda autot</h1>

<form method="post">

    <?php require 'car_form.php'; ?>

</form>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>

